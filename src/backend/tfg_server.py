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
from flask_session import Session
from sqlalchemy import create_engine
import predictions
import pandas as pd
import json
import numpy as np

app = Flask(__name__)
CORS(app)
bcrypt = Bcrypt(app)

mydb = connector.connect(
    host='localhost',
    user='root',
    password='',
    database='tfg_bd'
)

pipe_rfc = ''
pipe_lrc = ''
pipe_knn = ''
scores = {}

# Decorador para verificar el JWT
def token_required(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        token = None
       
        if 'x-access-token' in request.headers:
            token = request.headers['x-access-token']

        if not token:
            return { 'message' : 'Token is missing' }, 401
  
        try:
            data = jwt.decode(token, str(app.config['SECRET_KEY']), 'HS256')
            user = { 'public_id' : data['public_id'], 'is_admin' : data['type'] == 'admin' }
            
        except Exception as e:
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

        cursor = mydb.cursor()
        query = 'INSERT INTO users(name, surname_1, surname_2, email, password) VALUES (%s,%s,%s,%s,%s)'
        values = (name, surname_1, surname_2, email, password)
        
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

@app.route('/training', methods=['GET'])
@token_required
def train(current_user):
    response = {}

    global pipe_rfc
    global pipe_lrc
    global pipe_knn

    if request.method == 'GET':
        pipe_rfc, pipe_lrc, pipe_knn, scores = predictions.trainModels()

        response = scores
        status = 200
        return response, status

@app.route('/training/scores', methods=['POST'])
def getScores():
    response = {}
    status = 404

    if request.method == 'POST':
        print(session.get('scores', 'not set'))
    
        status = 200
        return response, status

@app.route('/predict', methods=['POST'])
#@token_required
def predict(current_user=''):
    status = 404
    if request.method == 'POST':
        features = request.form['features'].split(',')

        prediction = pipe_rfc.predict(np.array(features).reshape(1, -1))

        print(prediction[0])
        if prediction[0]:
            response = 'RECIVIVA'
        else:
            response = 'NO RECIVIVA'
  
        status = 200
        return response, status

@app.route('/importdb', methods=['POST', 'GET'])
def importdb():
    status = 400
    response = {}

    if request.method == 'POST':
        filename = request.form['filename']
        filepath = "../frontend/requests/tmp_uploads/" + filename
        #leer archivo
        df = pd.read_excel(filepath, header=1)
        #eliminar archivo del frontend
        os.remove(filepath)

        #limpiar datos
        df = clearDFdata(df)

        #pasar a csv para aumentar rapidez de procesamiento
        #df.to_csv("uploads/" + filename.split('.')[0] + '.csv', index=False, header=False)
        engine = create_engine('mysql://root:@localhost/tfg_bd', echo = False)
        df.to_sql(name='patients', con=engine, if_exists='append', index=False)

    return response

def clearDFdata(df):
    #cogemos los datos ya existentes para evitar duplicados
    cursor = mydb.cursor()
    
    query = f'SELECT * FROM patients'
    cursor.execute(query)

    #dataframe de la tabla que está en phpmyadmin
    df_db = pd.DataFrame(cursor.fetchall())
    df_db.columns = [i[0] for i in cursor.description]

    cursor.close()

    df = pd.concat([df, df_db]).drop_duplicates(keep=False)
    
    return df

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

