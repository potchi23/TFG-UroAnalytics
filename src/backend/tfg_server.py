import sys
from flask import Flask, request, Response
from mysql import connector
from mysql.connector import errorcode
from flask_cors import CORS
from flask_bcrypt import Bcrypt

app = Flask(__name__)
CORS(app)
bcrypt = Bcrypt(app)

@app.route('/login', methods=['GET','POST','DELETE'])
def login():
    status = 400
    response = {
        "errno": ''
    }

    if request.method == 'GET':
        return
    elif request.method == 'POST':
        email = request.form['email']
        password = request.form['password']

        cursor = mydb.cursor()
        query = f'SELECT name, surname_1, surname_2, email, password, accepted FROM users WHERE email=\"{email}\"'
        cursor.execute(query)
        
        if cursor.rowcount == 0:
            status = 404
            response['errno'] = 'Not Found'
        else:
            user_info = cursor.fetchone()
            if user_info[5] == 1 and bcrypt.check_password_hash(user_info[4], password) == True:
                    status = 200
                    response["name"] = user_info[0]
                    response["surname_1"] = user_info[1]
                    response["surname_2"] = user_info[2]
                    response["email"] = user_info[3]
            else:
                status = 404
                response["errno"] = 'Not Found'

        return response, status 

    elif request.method == 'DELETE':
        return
    else:
        return 'Method not supported', 400

@app.route('/register', methods=['POST'])
def register():
    status = 400
    response = {
        'errno': ''
    }
    
    if request.method == 'POST':
        name = request.form['name']
        surname_1 = request.form['surname_1']
        surname_2 = request.form['surname_2']
        email = request.form['email']
        password = bcrypt.generate_password_hash(request.form['password']).decode('utf-8')

        cursor = mydb.cursor()
        query = "INSERT INTO users(name, surname_1, surname_2, email, password) VALUES (%s,%s,%s,%s,%s)"
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
        return 'Method not supported', 400

@app.route('/register_petitions', methods=['GET','PATCH','DELETE'])
def register_petitions():
    status = 400
    
    if request.method == 'GET':
        cursor = mydb.cursor()
        query = 'SELECT id, name, surname_1, surname_2, email FROM users WHERE accepted = 0'
        cursor.execute(query)

        register_requests = {
            "data":[]
        }

        for register_request in cursor:
            data = {
                'id': register_request[0],
                'name':register_request[1],
                'surname_1':register_request[2],
                'surname_2':register_request[3],
                'email':register_request[4]
            }
            
            register_requests['data'].append(data)
        cursor.close()

        response = Response(str(register_requests))
        status = 200
        
        return response, status

    elif request.method == 'PATCH':
        cursor = mydb.cursor()
        user_id = request.form['id']

        query = f'SELECT name, email FROM users WHERE id = {user_id}'
        cursor.execute(query)

        user_data = {
            'data':[]
        }

        for register_request in cursor:
            data = {
                'name': register_request[0],
                'email':register_request[1]
            }
            
            user_data['data'].append(data)

        query = f'UPDATE users SET accepted = 1 WHERE id = {user_id}'
        cursor.execute(query)
        mydb.commit()

        cursor.close()

        response = Response(str(user_data))
        status = 200

        return response, status

    elif request.method == 'DELETE':
        cursor = mydb.cursor()
        user_id = request.form['id']
        
        query = f'SELECT name, email FROM users WHERE id = {user_id}'
        cursor.execute(query)

        user_data = {
            'data':[]
        }

        for register_request in cursor:
            data = {
                'name': register_request[0],
                'email':register_request[1]
            }
            
            user_data['data'].append(data)

        query = f'DELETE FROM users WHERE id = {user_id}'
        cursor.execute(query)
        mydb.commit()

        cursor.close()

        response = Response(str(user_data))
        status = 200

        return response, status

    else:
        return 'Method not supported', status

class FlaskConfig:
    '''Configuración de Flask'''
    # Activa depurador y recarga automáticamente
    ENV = 'development'
    DEBUG = True
    TEST = True
    # Imprescindible para usar sesiones
    SECRET_KEY = 'clave secreta que no se si habra que cambiar'
    STATIC_FOLDER = 'static'
    TEMPLATES_FOLDER = 'templates'


if __name__ == '__main__':
    app.config.from_object(FlaskConfig())

    mydb = connector.connect(
        host='localhost',
        user='root',
        password='',
        database='tfg_bd'
    )

    app.run()
