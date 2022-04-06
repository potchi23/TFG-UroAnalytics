from calendar import c
from itertools import count
import os
import sys
from flask import Flask, request, session
from mysql import connector
from flask_cors import CORS
from flask_bcrypt import Bcrypt
from functools import wraps
import jwt
from datetime import datetime, timedelta
# from sqlalchemy import create_engine
import sqlalchemy as sqla 
import predictions
import pandas as pd
import json
import numpy as np

HERE = os.path.dirname(os.path.abspath(__file__))

app = Flask(__name__)
CORS(app)
bcrypt = Bcrypt(app)

mydb = connector.connect(
    host='localhost',
    user='root',
    password='',
    database='tfg_bd'
)

engine = sqla.create_engine('mysql://root:@localhost/tfg_bd', echo = False)

pipe_rfc = ''
pipe_lrc = ''
pipe_knn = ''
pipe_best = ''
scores = {}
last_train = 'never'

# Decorador para verificar el JWT
def token_required(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        token = None
       
        if 'x-access-token' in request.headers:
            token = request.headers['x-access-token']

        if not token:
            print('Token is missing')
            return { 'message' : 'Token is missing' }, 401
  
        try:
            data = jwt.decode(token, str(app.config['SECRET_KEY']), 'HS256')
            user = { 'public_id' : data['public_id'], 'is_admin' : data['type'] == 'admin' }
            
        except Exception as e:
            print('Token is invalid')
            return { 'message' : 'Token is invalid' }, 401

        return  f(user, *args, **kwargs)
  
    return decorated

# Decorador para verificar si el usuario es un admin
def admin_required(f):
    @wraps(f)
    def decorated(user, *args, **kwargs):
        if not user['is_admin']:
            return { 'message' : 'Unauthorized' }, 403
        else:
            return f(*args, **kwargs)
  
    return decorated

@app.route('/', methods=['GET'])
def check():
    return {'message':'Server is running'}, 200

@app.route('/login', methods=['POST'])
def login():
    status = 400
    response = {}

    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']

        cursor = mydb.cursor()
        query = f'SELECT id, name, surname_1, surname_2, email, password, accepted, type FROM users WHERE email=\'{email}\''
        cursor.execute(query)
        user_info = cursor.fetchone()
        
        if not user_info:
            status = 401
            response['is_registered'] = False
            response['accepted'] = False
        else:
            if user_info[6] == 1 and bcrypt.check_password_hash(user_info[5], password):
                status = 200
                response['id'] = user_info[0]
                response['name'] = user_info[1]
                response['surname_1'] = user_info[2]
                response['surname_2'] = user_info[3]
                response['email'] = user_info[4]
                response['is_registered'] = True
                response['type'] = user_info[7]
                response['accepted'] = True
                response['token'] = jwt.encode({'public_id': response['id'], 'type' : response['type'], 'exp' : datetime.utcnow() + timedelta(minutes = 60) }, str(app.config['SECRET_KEY']), 'HS256')

            else:
                status = 401
                response['is_registered'] = True
                response['accepted'] = True

                if user_info[6] == 0:
                    response['accepted'] = False
        
        return response, status 

    else:
        response = 'Method not supported'
        print(response, file=sys.stderr)
        return response, status

@app.route('/register', methods=['POST'])
def register():
    status = 400
    response = {}
    
    if request.method == 'POST':
        name = request.form['name']
        surname_1 = request.form['surname_1']
        surname_2 = request.form['surname_2']
        email = request.form['email']
        password = bcrypt.generate_password_hash(request.form['password']).decode('utf-8')

        try:
            query = "INSERT INTO users(name, surname_1, surname_2, email, password) VALUES (%s,%s,%s,%s,%s)"
            values = (name, surname_1, surname_2, email, password)
            id = engine.execute(query, values)    
            status = 200        
        except:
            response['errno'] = "Error al registrarse"
            
        return response, status

    else:
        response = 'Method not supported'
        print(response, file=sys.stderr)
        return response, status

@app.route('/register_petitions', methods=['GET','PATCH','DELETE'])
@token_required
@admin_required
def register_petitions():
    status = 400

    if request.method == 'GET':
        offset = request.form['offset']
        num_elems = request.form['num_elems']

        cursor = mydb.cursor()
        query = f'SELECT id, name, surname_1, surname_2, email FROM users WHERE accepted = 0 LIMIT {offset}, {num_elems}'
        cursor.execute(query)

        response = {
            'num_entries':0,
            'data':[]
        }

        for register_request in cursor:
            data = {
                'id': register_request[0],
                'name':register_request[1],
                'surname_1':register_request[2],
                'surname_2':register_request[3],
                'email':register_request[4]
            }
            response['data'].append(data)
        
        query = f'SELECT COUNT(id) FROM users WHERE accepted = 0'
        cursor.execute(query)
        response['num_entries'] = cursor.fetchone()

        cursor.close()

        status = 200
        
        return response, status

    elif request.method == 'PATCH':
        cursor = mydb.cursor()
        user_id = request.form['id']

        query = f'SELECT name, email FROM users WHERE id = {user_id}'
        cursor.execute(query)
        data = cursor.fetchone()

        response = {}
            
        response['name'] = data[0]
        response['email'] = data[1]

        query = f'UPDATE users SET accepted = 1 WHERE id = {user_id}'
        cursor.execute(query)
        mydb.commit()

        cursor.close()

        status = 200

        return response, status

    elif request.method == 'DELETE':
        cursor = mydb.cursor()
        user_id = request.form['id']
        
        query = f'SELECT name, email FROM users WHERE id = {user_id}'
        cursor.execute(query)
        data = cursor.fetchone()

        response = {}
        
        response['name'] = data[0],
        response['email'] = data[1]
        
        query = f'DELETE FROM users WHERE id = {user_id}'
        cursor.execute(query)
        mydb.commit()

        cursor.close()

        status = 200

        return response, status

    else:
        response = 'Method not supported'
        print(response, file=sys.stderr)
        return response, status

@app.route('/users/<id>', methods=['GET','PATCH','DELETE'])
@token_required
def users(current_user, id):
    status = 400
    response = {}

    if request.method == 'GET':
        return 
    elif request.method == 'PATCH':
        if current_user['public_id'] != int(id):
            return {'message' : 'Forbidden'}, 403

        name = request.form['name']
        surname_1 = request.form['surname_1']
        surname_2 = request.form['surname_2']
        email = request.form['email']

        cursor = mydb.cursor()
        
        if request.form['password'] != '':
            password = bcrypt.generate_password_hash(request.form['password']).decode('utf-8')
            query = f'UPDATE users SET name=\'{name}\', surname_1=\'{surname_1}\', surname_2=\'{surname_2}\', email=\'{email}\', password=\'{password}\' WHERE id={id}'
        else:
            query = f'UPDATE users SET name=\'{name}\', surname_1=\'{surname_1}\', surname_2=\'{surname_2}\', email=\'{email}\' WHERE id={id}'

        cursor.execute(query)
        mydb.commit()
        cursor.close()
        
        response = 'User updated'
        status = 200

        return response, status

    elif request.method == 'DELETE':
        if current_user['public_id'] != int(id):
            return {'message' : 'Forbidden'}, 403
        
        cursor = mydb.cursor()
        
        query = f'SELECT name, email FROM users WHERE id = {id}'
        cursor.execute(query)
        data = cursor.fetchone()
        
        response['name'] = data[0],
        response['email'] = data[1]

        query = f'DELETE FROM users WHERE id={id}'

        cursor.execute(query)
        mydb.commit()
        cursor.close()

        status = 200
        
        return response, status

    else:
        return 'Method not supported', status

@app.before_first_request
def trainOnStartup():
    global pipe_rfc
    global pipe_lrc
    global pipe_knn
    global pipe_best

    global scores
    global last_train
    last_train = datetime.utcnow()
    # engine = create_engine('mysql://root:@localhost/tfg_bd', echo = False)
    df = pd.read_sql('SELECT * FROM patients', engine)
    if not df.empty:
        pipe_rfc, pipe_lrc, pipe_knn, pipe_best, scores = predictions.trainModels(df)

@app.route('/training', methods=['GET'])
@token_required
def train(current_user):
    response = {}

    global pipe_rfc
    global pipe_lrc
    global pipe_knn
    global pipe_best

    global scores
    global last_train

    if request.method == 'GET':
        # engine = create_engine('mysql://root:@localhost/tfg_bd', echo = False)
        df = pd.read_sql('SELECT * FROM patients', engine)

        pipe_rfc, pipe_lrc, pipe_knn, pipe_best, scores = predictions.trainModels(df)
    
        last_train =  datetime.utcnow()
        response = {}
        status = 200

        return response, status

@app.route('/training/scores', methods=['GET'])
@token_required
def getScores(current_user=''):
    response = {}
    status = 404

    if request.method == 'GET':
        global scores
        response = scores

        status = 200
        return response, status

@app.route('/training/lastTraining', methods=['GET'])
@token_required
def getLastTraining(current_user=''):
    if request.method == 'GET':
        global last_train

        return last_train.strftime("%d/%m/%Y %H:%M:%S"), 200

@app.route('/predict', methods=['POST'])
@token_required
def predict(current_user=''):
    status = 404
    if request.method == 'POST':
        features = request.form['features'].split(',')
        algorithm = request.form['algorithm']

        if(algorithm == 'rfc'):
            prediction = pipe_rfc.predict(np.array(features).reshape(1, -1))
        elif (algorithm == 'lrc'):
            prediction = pipe_lrc.predict(np.array(features).reshape(1, -1))
        elif (algorithm == 'knn'):
            prediction = pipe_knn.predict(np.array(features).reshape(1, -1))
        else:
            prediction = pipe_best.predict(np.array(features).reshape(1, -1))

        if prediction[0] == 1:
            response = 'SI (CASOS)'
        elif prediction[0] == 2:
            response = 'NO (CONTROLES)'
        elif prediction[0] == 3: 
            response = 'PERSISTENCIA PSA'
        else:
            response = 'error'

        print('[LOG] Result RBQ:', prediction[0])
        status = 200
        return response, status

@app.route('/importdb', methods=['POST'])
@token_required
def importdb(current_user):
    status = 400
    response = {
        'num_entries':0,
    }

    if request.method == 'POST':
        filename = request.form['filename']
        filepath = HERE + "/tmp_uploads/" + filename
        #leer archivo
        df = pd.read_excel(filepath, header=0)
        #eliminar archivo del frontend
        os.remove(filepath)

        df = newPatientsDF(df)
        
        df.to_sql(name='patients', con=engine, if_exists='append', index=False)
        
        response['num_entries'] = len(df.index)

        status = 200
        return response, status

def newPatientsDF(df):
    '''
    Devuelve los pacientes que no están incluidos en la base de datos.
    Parámetros:
        df: dataFrame del excel
    '''
    query = f'SELECT * FROM patients'

    df_db = pd.read_sql(query, engine)

    #columnas del excel en mayusculas y cambios de espacios por guiones
    df.columns = df.columns.map(str)
    df.columns = df.columns.map(str.upper)
    df.columns = df.columns.str.replace(' ', '-')

    #drop de las columnas no incluidas en la base de datos
    columns_to_include = df.columns.intersection(df_db.columns)

    if "N" in columns_to_include:
        columns_to_include = columns_to_include.drop("N")
    
    df = df[columns_to_include]

    if not df_db.empty:
        df = pd.concat([df_db.drop(columns="N"), df]).drop_duplicates(keep=False, ignore_index=True)
    else:
        df = df.drop_duplicates(ignore_index=True)

    return df

@app.route('/exportdb', methods=['GET'])
@token_required
def exportdb(current_user):
    status = 400
    response = {}

    if request.method == 'GET':
        query = "SELECT * FROM patients"
        df_db = pd.read_sql(query, engine)        

        df_db["FECHACIR"] = pd.to_datetime(df_db["FECHACIR"]).dt.strftime('%d-%m-%Y')
        df_db["FECHAFIN"] = pd.to_datetime(df_db["FECHAFIN"]).dt.strftime('%d-%m-%Y')

        json = df_db.to_json(orient = 'columns', date_format='iso')

        response['json'] = json        
        status = 200
        return response, status

    else:
        response = 'Method not supported'
        return response, status


@app.route('/getQuery', methods=['GET'])
def doQuery():
    status = 400
    response = {}

    if request.method == 'GET':

        query = buildQuery(request.form); 
        print(query)
        df_db = pd.read_sql(query, engine)
        print(df_db)

    return response

def buildQuery(req):
    query = "SELECT * FROM patients WHERE "
    operators = "=<>"
    keys = list(req.keys())
    for i in req:
        if req[i][0] in operators:
            query = query + i + " " + req[i]
        else:
            query = query + i + " = " + req[i]
        if i != keys[-1]:
            query = query + " AND "

    return query

@app.route('/patients', methods=['POST', 'GET'])
@token_required
def viewPatients(current_user):
    status = 400
    response = {}
    if request.method == 'GET':
        offset = request.form['offset']
        num_elems = request.form['num_elems']

        cursor = mydb.cursor()
        query = f'SELECT * FROM patients LIMIT {offset}, {num_elems}'
        cursor.execute(query)

        response = {
            'num_entries':0,
            'data':[]
        }

        entry = {}
        for request_p in cursor:
            for i in range(0, len(request_p)):
                
                entry[cursor.description[i][0]] = request_p[i]
                                    
            response['data'].append(dict(entry))
    
        query = f'SELECT COUNT(N) FROM patients'
        cursor.execute(query)
        response['num_entries'] = cursor.fetchone()

        cursor.close()
        status = 200
        
        return response, status

    elif  request.method == 'POST':
        FECHACIR = request.form['FECHACIR']
        EDAD = request.form['EDAD']
        ETNIA = request.form['ETNIA']
        HTA = request.form['HTA']
        DM = request.form['DM']
        TABACO = request.form['TABACO']
        HEREDA = request.form['HEREDA']
        TACTOR = request.form['TACTOR']
        PSAPRE = request.form['PSAPRE']
        PSALT = request.form['PSALT']
        TDUPPRE = request.form['TDUPPRE']
        ECOTR = request.form['ECOTR']
        NBIOPSIA = request.form['NBIOPSIA']
        HISTO = request.form['HISTO']
        GLEASON1 = request.form['GLEASON1']
        NCILPOS = request.form['NCILPOS']
        BILAT = request.form['BILAT']
        PORCENT = request.form['PORCENT']
        IPERIN = request.form['IPERIN']
        ILINF = request.form['ILINF']
        IVASCU = request.form['IVASCU']
        TNM1 = request.form['TNM1']
        HISTO2 = request.form['HISTO2']
        GLEASON2 = request.form['GLEASON2']
        BILAT2 = request.form['BILAT2']
        LOCALIZ = request.form['LOCALIZ']
        MULTIFOC = request.form['MULTIFOC']
        VOLUMEN = request.form['VOLUMEN']
        EXTRACAP = request.form['EXTRACAP']
        VVSS = request.form['VVSS']
        IPERIN2 = request.form['IPERIN2']
        ILINF2 = request.form['ILINF2']
        IVASCU2 = request.form['IVASCU2']
        PINAG = request.form['PINAG']
        MARGEN = request.form['MARGEN']
        TNM2 = request.form['TNM2']
        PSAPOS = request.form['PSAPOS']
        RTPADYU = request.form['RTPADYU']
        RTPMES = request.form['RTPMES']
        RBQ = request.form['RBQ']
        TRBQ = request.form['TRBQ']
        TDUPLI = request.form['TDUPLI']
        TDUPLI_r1 = request.form['TDUPLI.r1']
        T1MTX = request.form['T1MTX']
        FECHAFIN = request.form['FECHAFIN']
        t_seg = request.form['t.seg']
        FALLEC = request.form['FALLEC']
        TSUPERV = request.form['TSUPERV']
        TSEGUI = request.form['TSEGUI']
        PSAFIN = request.form['PSAFIN']
        CAPRA_S = request.form['CAPRA-S']
        RA_nuclear = request.form['RA-NUCLEAR']
        RA_estroma = request.form['RA-ESTROMA']
        PTEN = request.form['PTEN']
        ERG = request.form['ERG']
        KI_67 = request.form['KI-67']
        SPINK1 = request.form['SPINK1']
        C_MYC = request.form['C-MYC']
        NOTAS = request.form['NOTAS']
        IMC = request.form['IMC']
        ASA = request.form['ASA']
        GR = request.form['GR']
        PNV = request.form['PNV']
        TQ = request.form['TQ']
        TH = request.form['TH']
        NGG = request.form['NGG']
        PGG = request.form['PGG']
        
        cursor = mydb.cursor()
        query = 'INSERT INTO patients(FECHACIR, EDAD, ETNIA, HTA, DM, TABACO, HEREDA, TACTOR, PSAPRE, PSALT, TDUPPRE, ECOTR, NBIOPSIA, HISTO, GLEASON1, NCILPOS, BILAT, PORCENT, IPERIN, ILINF,IVASCU, TNM1, HISTO2, GLEASON2, BILAT2, LOCALIZ, MULTIFOC, VOLUMEN, EXTRACAP, VVSS, IPERIN2, ILINF2, IVASCU2, PINAG, MARGEN, TNM2, PSAPOS, RTPADYU, RTPMES, RBQ, TRBQ, TDUPLI, TDUPLI.r1, T1MTX, FECHAFIN, t.seg, FALLEC, TSUPERV, TSEGUI, PSAFIN, CAPRA S, RA-NUCLEAR, RA-ESTROMA, PTEN, ERG, KI-67, SPINK1, C-MYC, NOTAS, IMC, ASA, GR, PNV, TQ, TH, NGG, PGG) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)'
        values = (FECHACIR, EDAD, ETNIA, HTA, DM, TABACO, HEREDA, TACTOR, PSAPRE, PSALT, TDUPPRE, ECOTR, NBIOPSIA, HISTO, GLEASON1, NCILPOS, BILAT, PORCENT, IPERIN, ILINF,IVASCU, TNM1, HISTO2, GLEASON2, BILAT2, LOCALIZ, MULTIFOC, VOLUMEN, EXTRACAP, VVSS, IPERIN2, ILINF2, IVASCU2, PINAG, MARGEN, TNM2, PSAPOS, RTPADYU, RTPMES, RBQ, TRBQ, TDUPLI, TDUPLI_r1, T1MTX, FECHAFIN, t_seg, FALLEC, TSUPERV, TSEGUI, PSAFIN, CAPRA_S, RA_nuclear, RA_estroma, PTEN, ERG, KI_67, SPINK1, C_MYC, NOTAS, IMC, ASA, GR, PNV, TQ, TH, NGG, PGG)
        
        try:
            cursor.execute(query, values)
            mydb.commit()
            status = 200
        except connector.Error as e:
            print(e, file=sys.stderr)
            response['errno'] = e.errno
        finally:
            cursor.close()

            return response, status
            
class FlaskConfig:
    '''Configuración de Flask'''
    # Activa depurador y recarga automáticamente
    ENV = 'development'
    DEBUG = True
    TEST = True
    # Imprescindible para usar sesiones
    SECRET_KEY = os.getenv('SECRET_KEY', 'secret')
    STATIC_FOLDER = 'static'
    TEMPLATES_FOLDER = 'templates'


if __name__ == '__main__':
    app.config.from_object(FlaskConfig())
    app.run()

