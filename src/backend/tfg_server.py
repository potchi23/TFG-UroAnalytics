import os
import sys
from unittest import result
from flask import Flask, request
from flask_cors import CORS
from flask_bcrypt import Bcrypt
from functools import wraps
import jwt
from datetime import datetime, timedelta
import sqlalchemy as sqla 
import predictions
import pandas_profiling
import pandas as pd
import json
import numpy as np
import base64
import threading
import matplotlib
matplotlib.use('Agg')
from matplotlib import pyplot

HERE = os.path.dirname(os.path.abspath(__file__))
SESSION_EXPIRATION_IN_MINUTES = 120

app = Flask(__name__)
CORS(app)
bcrypt = Bcrypt(app)

engine = sqla.create_engine('mysql://root:@localhost/tfg_bd', echo = False)

pipe_rfc = None
pipe_lrc = None
pipe_knn = None
pipe_best = None
scores = {}
last_train = 'never'

user_threads = {}

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

        query = 'SELECT id, name, surname_1, surname_2, email, password, accepted, type FROM users WHERE email=%s'
        params = (email)
        user_info = engine.execute(query, params).fetchone()
        
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
                response['token'] = jwt.encode({'public_id': response['id'], 'type' : response['type'], 'exp' : datetime.utcnow() + timedelta(minutes = SESSION_EXPIRATION_IN_MINUTES) }, str(app.config['SECRET_KEY']), 'HS256')

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
            query = 'INSERT INTO users(name, surname_1, surname_2, email, password) VALUES (%s,%s,%s,%s,%s)'
            values = (name, surname_1, surname_2, email, password)
            engine.execute(query, values)    
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
        offset = int(request.form['offset'])
        num_elems = int(request.form['num_elems'])

        query = 'SELECT id, name, surname_1, surname_2, email FROM users WHERE accepted = 0 LIMIT %s, %s'
        params = (offset, num_elems)
        result = engine.execute(query, params).fetchall()

        response = {
            'num_entries':0,
            'data':[]
        }

        for register_request in result:
            user_data = {
                'id': register_request[0],
                'name':register_request[1],
                'surname_1':register_request[2],
                'surname_2':register_request[3],
                'email':register_request[4]
            }
            response['data'].append(user_data)
        
        query = 'SELECT COUNT(id) FROM users WHERE accepted = 0'
        result = engine.execute(query).fetchone()
        response['num_entries'] = result[0]
        
        status = 200
        
        return response, status

    elif request.method == 'PATCH':
        user_id = int(request.form['id'])

        query = 'SELECT name, email FROM users WHERE id = %s'
        params = (user_id)
        data = engine.execute(query, params).fetchone()
        
        response = {}
            
        response['name'] = data[0]
        response['email'] = data[1]

        query = 'UPDATE users SET accepted = 1 WHERE id = %s'
        engine.execute(query, params)

        status = 200

        return response, status

    elif request.method == 'DELETE':
        user_id = int(request.form['id'])
        
        query = 'SELECT name, email FROM users WHERE id = %s'
        params = (user_id)
        data = engine.execute(query, params).fetchone()

        response = {}
        
        response['name'] = data[0],
        response['email'] = data[1]
        
        query = 'DELETE FROM users WHERE id = %s'
        engine.execute(query, params)

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
        id = int(id)

        if request.form['password'] != '':
            password = bcrypt.generate_password_hash(request.form['password']).decode('utf-8')
            query = 'UPDATE users SET name=%s, surname_1=%s, surname_2=%s, email=%s, password=%s WHERE id=%s'
            params = (name, surname_1, surname_2, email, password, id)
        else:
            query = 'UPDATE users SET name=%s, surname_1=%s, surname_2=%s, email=%s WHERE id=%s'
            params = (name, surname_1, surname_2, email, id)

        engine.execute(query, params)

        response = 'User updated'
        status = 200

        return response, status

    elif request.method == 'DELETE':
        if current_user['public_id'] != int(id):
            return {'message' : 'Forbidden'}, 403

        id = int(id)
        query = 'SELECT name, email FROM users WHERE id = %s'
        params = (id)
        data = engine.execute(query, params).fetchone()
        
        response['name'] = data[0],
        response['email'] = data[1]

        query = 'DELETE FROM users WHERE id=%s'
        engine.execute(query, params)

        status = 200
        
        return response, status

    else:
        response = 'Method not supported'
        print(response, file=sys.stderr)
        return response, status

@app.before_first_request
def trainOnStartup():
    global pipe_rfc
    global pipe_lrc
    global pipe_knn
    global pipe_best

    global scores
    global last_train
    last_train = datetime.utcnow()
    df = pd.read_sql('SELECT * FROM patients LIMIT 204', engine)
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
        df = pd.read_sql('SELECT * FROM patients LIMIT 204', engine)

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
    
@app.route('/getColumns', methods=['GET'])
@token_required
def getCols(current_user=''):
    response = {}
    status = 400
    if request.method == 'GET':
        df = pd.read_sql("SELECT * FROM PATIENTS", engine)
        response["data"] = list(df.columns)
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

@app.route('/import_prediction', methods=['POST'])
@token_required
def import_prediction(current_user):
    status = 400
    response = {}

    if request.method == 'POST':
        file = base64.b64decode(request.form['file'])
        filename = HERE + "/tmp_uploads/prediction_tmp.xlsx"
        
        if os.path.exists(filename):
            os.remove(filename)

        with open(filename, 'wb') as excel_file:
            excel_file.write(file)

        df = pd.read_excel(filename, header=0)
        os.remove(filename)
        df.columns = df.columns.str.upper()
        df.columns = df.columns.str.replace(' ', '-')

        response = df.to_json()

        df, errorMSG = newPatientsDF(df)
        if errorMSG == None:
            status = 200
        else:
            response['errorMSG'] = errorMSG

        return response, status

@app.route('/database', methods=['GET', 'POST'])
@token_required
def database(current_user):
    status = 400
    response = {}

    if request.method == 'GET':
        query = 'SELECT * FROM patients '

        if len(request.form) != 0:
            query += buildQuery(request.form)[0]
        
        df_db = pd.read_sql(query, engine)        

        df_db["FECHACIR"] = pd.to_datetime(df_db["FECHACIR"]).dt.strftime('%d-%m-%Y')
        df_db["FECHAFIN"] = pd.to_datetime(df_db["FECHAFIN"]).dt.strftime('%d-%m-%Y')

        json = df_db.to_json(orient = 'columns', date_format='iso')

        response['json'] = json        
        status = 200

        return response, status
    
    elif request.method == 'POST':
        file = base64.b64decode(request.form['file'])
        filename = HERE + "/tmp_uploads/import_tmp.xlsx"

        if os.path.exists(filename):
            os.remove(filename)

        with open(filename, 'wb') as excel_file:
            excel_file.write(file)

        #leer archivo
        df = pd.read_excel(filename, header=0)
        
        #eliminar archivo del frontend
        os.remove(filename)

        df, errorMSG = newPatientsDF(df)
        if errorMSG == None:
            df.to_sql(name='patients', con=engine, if_exists='append', index=False)
            response['num_entries'] = len(df.index)
            status = 200
        else:
            response['errorMSG'] = errorMSG
        return response, status

    else:
        response = 'Method not supported'
        print(response, file=sys.stderr)
        return response, status
    

def newPatientsDF(df):
    '''
    Devuelve los pacientes que no están incluidos en la base de datos.
    Parámetros:
        df: dataFrame del excel
    '''
    errorMSG = None
    query = 'SELECT * FROM patients'

    df_db = pd.read_sql(query, engine)

    #columnas del excel en mayusculas y cambios de espacios por guiones
    df.columns = df.columns.map(str)
    df.columns = df.columns.map(str.upper)
    df.columns = df.columns.str.replace(' ', '-')

    #columnas incluidas en el excel y la base de datos
    columns_to_include = df.columns.intersection(df_db.columns)

    if len(columns_to_include) > 0:
        if "N" in columns_to_include:
            columns_to_include = columns_to_include.drop("N")
        
        df = df[columns_to_include]

        df, invalidColumns = clearPatientsDF(df)
        
        if len(invalidColumns) == 0:
            if not df_db.empty:
                df = pd.concat([df_db.drop(columns="N"), df, df_db.drop(columns="N")]).drop_duplicates(keep=False, ignore_index=True)
            else:
                df = df.drop_duplicates(ignore_index=True)
        else:
            errorMSG = f"Hay columnas con tipos invalidos: {', '.join(invalidColumns)}."
    else:
        errorMSG = "No hay columnas coincidentes con la base de datos."

    return df, errorMSG

def clearPatientsDF(df):
    variablesJson = open('jsons/variables.json', 'r')
    dataJson = json.load(variablesJson)
    
    invalidColumns = list()
        
    #Por cada columna del DF, comprobar el tipo de la columna y que los datos esten comprendidos entre los rangos permitidos
    for column in df.columns:
        if str(df[column].dtype) in dataJson[column]["tipo"]:
            rango = dataJson[column]["rango"]
            if len(rango) > 0:
                rangoInf = rango[0]
                rangoSup= rango[1]
                #Drop de las filas en las cuales no haya datos validos
                df = df[((df[column] >= rangoInf) & (df[column] <= rangoSup)) | (df[column].isnull())]
        else:
            invalidColumns.append(column)

    df.reset_index(drop=True, inplace=True)    

    return df, invalidColumns


@app.route('/getQuery', methods=['GET'])
def doQuery():
    status = 400
    response = {
        'num_entries':0,
        'data':[],
        'errorMsg': ""
    }

    if request.method == 'GET':
        if len(request.form) > 2:
            offset = request.form['offset']
            num_elems = request.form['num_elems']
            queryWhere, num_entries = buildQuery(request.form); 
            queryWhere += ' LIMIT %s, %s' % (offset, num_elems)

            result_patients = pd.read_sql("SELECT * FROM PATIENTS " + queryWhere, engine)

            if not result_patients.empty:
                status = 200
                df_aux = dbTranslator(result_patients.fillna(""))
                response['data'] = df_aux.to_dict(orient='records')
            else:
                status = 404
                response["errorMsg"] = "No hay pacientes que concuerden con la consulta."

            response['num_entries'] = num_entries
        else:
            response["errorMsg"] = "Consulta vacía."

    return response, status

def buildQuery(req):
    req = dict(req)

    req.pop('offset', None)
    req.pop('num_elems', None)

    query = ''
    if(len(req) > 0):
        query = "WHERE "
        operators = "=<>"
        keys = list(req.keys())
        for i in req:
            if req[i] != '' and "drop" not in i and "extended" not in i:
                if req[i][0] in operators:
                    query = query + i + " " + req[i]
                else:
                    query = query + i + " = " + req[i]
                query = query + " AND "
        if query[len(query)-4:len(query)] == "AND ":
            query = query[:len(query) - 4]
    
    num_entries = pd.read_sql("SELECT * FROM patients " + query, engine).shape[0]

    return query, num_entries

@app.route('/getDetails', methods=['GET'])
@token_required
def getDetails(current_user):
    status = 400
    response = {}

    if request.method == 'GET':
        if len(request.form) > 2:
            query = str(buildQuery(request.form)[0])

            columns, status = getCols()
            minimal = True

            if status == 200:
                for i in request.form:
                    if "drop" in i:
                        columns["data"].pop(columns["data"].index(request.form[i]))
                        
                minimal = request.form["extended"]
                
                for i in range(0, len(columns["data"])):
                    if "-" in columns["data"][i] or "." in columns["data"][i]:
                        columns["data"][i] = "'" + columns["data"][i] + "'"
                
                df = pd.read_sql("SELECT " + ", ".join(columns["data"]) + " FROM PATIENTS " + query, engine)

                if str(current_user['public_id']) not in user_threads:
                    user_threads[str(current_user['public_id'])] = threading.Thread(target=detailsThread, kwargs={'df': df, 'current_user': current_user, 'minimal': minimal}, daemon = True)
                    user_threads[str(current_user['public_id'])].start()
                    response = str(current_user['public_id'])
                else:
                    response["errorMsg"] = "Ya se están generando detalles. Por favor espere a que termine."
                    status = 503
        else:
            response["errorMsg"] = "Consulta vacía."

    return response, status

@app.route('/getDetailsFile', methods=['GET'])
def getDetailsFile():
    status = 400
    response = {"data": "",
                "errorMSG": ""}

    if request.method == 'GET':
        try:
            if user_threads[request.form['current_user']].is_alive():
                user_threads[request.form['current_user']].join()
            user_threads.pop(request.form['current_user'])
            
            file = open("detalles" + request.form['current_user'] + ".html", "r", encoding="utf8")
            response["data"] = file.read()
            file.close()
            os.remove("detalles" + request.form['current_user'] + ".html") 
            status = 200

        except:
            response["errorMSG"] = "Error al leer el archivo de detalles."

    return response, status

def detailsThread(df, current_user, minimal):
    try:
        detalles = pandas_profiling.ProfileReport(df, title="Patient Details", minimal=minimal)
        detalles.to_file("detalles" + str(current_user['public_id']) + ".html")
    except:
        print("Error al generar el pandas profiling.")
    return

@app.route('/numPatients', methods=['GET'])
@token_required
def numPatients(current_user):
    status = 401
    response = {}

    if request.method == 'GET':        
        query = "SELECT COUNT(N) FROM patients"
        result = pd.read_sql(query, engine)
        response['num_patients'] = int(result['COUNT(N)'].iloc[0])
        status = 200
        return response, status
            
    else:
        response = 'Method not supported'
        print(response, file=sys.stderr)
        return response, status

@app.route('/patients', methods=['POST', 'GET'])
@token_required
def viewPatients(current_user):
    status = 400
    response = {}
    if request.method == 'GET':
        offset = int(request.form['offset'])
        num_elems = int(request.form['num_elems'])
        response = {
            'num_entries':engine.execute('SELECT COUNT(N) FROM patients').scalar(),
            'data':[]
        }

        query = 'SELECT * FROM patients '

        if('rbq_null' in request.form and request.form['rbq_null'] == 'true'):
            query += 'WHERE RBQ IS NULL '

        query += ' LIMIT %s, %s' % (offset, num_elems)
        
        patients = pd.read_sql(query, engine)

        df_aux = dbTranslator(patients.fillna(""))
        response['data'] = df_aux.to_dict(orient='records')
        
        if('rbq_null' in request.form and request.form['rbq_null'] == 'true'):
            response['num_entries'] = len(response['data'])

        status = 200
        return response, status

    elif  request.method == 'POST':
        print(request.form)
        response = {
            "errorMSG" : "",
            "num_entries" : 0
        }

        if(len(request.form) <= 0):
            response["errorMSG"] = "Tiene que rellenar al menos uno de los campos."
        else:
            
            df, response["errorMSG"] = insertDF(request.form)

            try:
                if not df.empty:
                    df.to_sql(name='patients', con=engine, if_exists='append', index=False)
                    status = 200        
                    response["num_entries"] = 1
                else:
                    response["errorMSG"] = "El paciente introducido ya existe."
            except:
                response["errorMSG"] = "Error al insertar en la base de datos."   
             
        return response, status

def insertDF(req):

    req = dict(req)

    df = pd.DataFrame([req.values()], columns=list(req.keys())).replace({"": np.nan})

    #casteo de valores
    df_db = pd.read_sql("SELECT * FROM patients", engine).iloc[:1]

    for col in df_db.columns:
        if col in df.columns:
            df[col] = df[col].astype(df_db[col].dtype)

    errorMSG = ""
    df, errorMSG = newPatientsDF(df)

    return df, errorMSG




@app.route('/patients/<patientId>', methods=['GET', 'PATCH'])
@token_required
def viewSinglePatient(current_user, patientId):
    status = 400
    response = {}
    if request.method == 'GET':
        params = (patientId)
        response = {
            'num_entries':engine.execute('SELECT COUNT(N) FROM patients WHERE N = %s', params).scalar(),
            'data':[],
            'errorMsg': ""
        }

        if response['num_entries'] != 0:
            query = 'SELECT * FROM patients WHERE N = %s'
            if('rbq_null' in request.form and request.form['rbq_null'] == 'true'):
                query += ' AND RBQ IS NULL'

            
            columns = tuple(engine.execute(query, params).keys())
            result = engine.execute(query, params)

            entry = {}
            for row in result:
                for i in range(0, len(row)):
                    entry[columns[i]] = row[i]
                response['data'].append(dict(entry))
            
            if('rbq_null' in request.form and request.form['rbq_null'] == 'true'):
                response['num_entries'] = len(response['data'])
                
            status = 200
        else:
            response['errorMsg'] = "No existen pacientes con el id proporcionado."

    elif request.method == 'PATCH':
        response = {}
        predictionResult = request.form['predictionResult']
        print("result " + predictionResult)
        query = 'UPDATE patients SET RBQ = %s WHERE N = %s'
        params = (predictionResult, patientId)

        engine.execute(query, params)
        
        status = 200

    return response, status

@app.route('/patients/variables', methods=['POST', 'GET'])
@token_required
def patientVariables(current_user):
    response = {
        'data':[]
    }
    if request.method == 'GET':
        query = 'SELECT * FROM patients LIMIT 1'
        columns = list(engine.execute(query).keys())
        response['data'] = columns

        return response, 200

def dbTranslator(df):
    variablesJson = open('jsons/variables.json', 'r')
    dataJson = json.load(variablesJson)
    
    invalidColumns = list()

    for column in df.columns:
        if column != 'N':
            df[column] = df[column].astype(str)
            if len(dataJson[column]["reemplazar"]) > 0:
                df[column] = df[column].replace(dataJson[column]["reemplazar"])
    
    return df

@app.route('/graphicPatients', methods=['GET'])
def getGraphics():
    status = 400
    response = {
        'EDAD':{},
        'TABACO':{},
        'OBESO':{},
        'ETNIA':{},
        'RBQ':{},
        'HEREDA':{},
        'TACTOR':{},
        'ECOTR':{}
    }
    query = "SELECT * FROM patients "
    if len(request.form) > 0:
        query += buildQuery(request.form)[0]

    patients = pd.read_sql(query, engine)

    edadDF = pd.DataFrame(columns=["JOVEN", "ADULTO", "3EDAD"], data={"JOVEN" : [patients[patients["EDAD"] < 18].shape[0]], 
                                                                        "ADULTO" : [patients[(patients["EDAD"] >= 18) & (patients["EDAD"] < 65)].shape[0]], 
                                                                        "3EDAD" : [patients[patients["EDAD"] >= 65].shape[0]]})
    
    tabacoDF = pd.DataFrame(columns=["NC", "NO", "EXFUMADOR","10CIG_DIA","10-20CIG_DIA","20CIG_DIA"], data={
                                                                        "NC" : [patients[patients["TABACO"] == 0].shape[0]], 
                                                                        "NO" : [patients[patients["TABACO"] == 1].shape[0]],
                                                                        "EXFUMADOR" : [patients[patients["TABACO"] == 2].shape[0]],
                                                                        "10CIG_DIA" : [patients[patients["TABACO"] == 3].shape[0]],
                                                                        "10-20CIG_DIA" : [patients[patients["TABACO"] == 4].shape[0]],
                                                                        "20CIG_DIA" : [patients[patients["TABACO"] == 5].shape[0]]})

    obesoDF = pd.DataFrame(columns=["NC", "IMC < 25", "IMC 25-30", "IMC > 30"], data={"NC" : [patients[patients["OBESO"] == 0].shape[0]], 
                                                                                    "IMC < 25" : [patients[patients["OBESO"] == 1].shape[0]],
                                                                                    "IMC 25-30" : [patients[patients["OBESO"] == 2].shape[0]],
                                                                                    "IMC > 30" : [patients[patients["OBESO"] == 3].shape[0]]})

    etniaDF = pd.DataFrame(columns=["Caucasico", "Negro", "Hispano", "Asiatico"], data={"Caucasico" : [patients[patients["ETNIA"] == 1].shape[0]], 
                                                                                    "Negro" : [patients[patients["ETNIA"] == 2].shape[0]],
                                                                                    "Hispano" : [patients[patients["ETNIA"] == 3].shape[0]],
                                                                                    "Asiatico" : [patients[patients["ETNIA"] == 4].shape[0]]})

    rbqDF = pd.DataFrame(columns=["SI", "NO", "PERSISTENCIA_PSA"], data={"SI" : [patients[patients["RBQ"] == 0].shape[0]], 
                                                                        "NO" : [patients[patients["RBQ"] == 1].shape[0]], 
                                                                        "PERSISTENCIA_PSA" : [patients[patients["RBQ"] ==2].shape[0]]})
    
    heredaDF = pd.DataFrame(columns=["Si", "No"], data={"Si" : [patients[patients["HEREDA"] == 1].shape[0]], 
                                                        "No" : [patients[patients["HEREDA"] == 2].shape[0]]})

    tactorDF = pd.DataFrame(columns=["NEGATIVO", "SOSPECHOSO", "POSITIVO"], data={"NEGATIVO" : [patients[patients["TACTOR"] == 0].shape[0]], 
                                                                        "SOSPECHOSO" : [patients[patients["TACTOR"] == 1].shape[0]], 
                                                                        "POSITIVO" : [patients[patients["TACTOR"] ==2].shape[0]]})
    
    ecotrDF = pd.DataFrame(columns=["NORMAL", "SOSPECHOSA"], data={"NORMAL" : [patients[patients["ECOTR"] == 0].shape[0]], 
                                                                        "SOSPECHOSA" : [patients[patients["ECOTR"] == 1].shape[0]]})
                                                                        
    response['EDAD'] = edadDF.to_dict(orient="records")[0]
    response['TABACO'] = tabacoDF.to_dict(orient="records")[0]
    response['OBESO'] = obesoDF.to_dict(orient="records")[0]
    response['ETNIA'] = etniaDF.to_dict(orient="records")[0]
    response['RBQ'] = rbqDF.to_dict(orient="records")[0]
    response['HEREDA'] = heredaDF.to_dict(orient="records")[0]
    response['TACTOR'] = tactorDF.to_dict(orient="records")[0]
    response['ECOTR'] = ecotrDF.to_dict(orient="records")[0]

    status = 200
    # except:
    #     response["errorMSG"] = "Error en la obtención de vistas."   
    return response,status

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
    app.run('0.0.0.0', 5000, threaded=True)
