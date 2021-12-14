import sys
from flask import Flask, request, Response
from mysql import connector
from mysql.connector import errorcode
from flask_cors import CORS
from flask_bcrypt import Bcrypt

app = Flask(__name__)

CORS(app)
bcrypt = Bcrypt(app)

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
            status = 404
            response['is_registered'] = False
        else:
            if user_info[6] == 1 and bcrypt.check_password_hash(user_info[5], password) == True:
                status = 200
                response['id'] = user_info[0]
                response['name'] = user_info[1]
                response['surname_1'] = user_info[2]
                response['surname_2'] = user_info[3]
                response['email'] = user_info[4]
                response['is_registered'] = True
                response['type'] = user_info[7]
                response['accepted'] = True
            else:
                status = 404
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
def register_petitions():
    status = 400
    
    if request.method == 'GET':
        cursor = mydb.cursor()
        query = 'SELECT id, name, surname_1, surname_2, email FROM users WHERE accepted = 0'
        cursor.execute(query)

        response = {
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
        cursor.close()

        status = 200
        
        return response, status

    elif request.method == 'PATCH':
        cursor = mydb.cursor()
        user_id = request.form['id']

        query = f'SELECT name, email FROM users WHERE id = {user_id}'
        cursor.execute(query)

        response = {
            'data':[]
        }

        for register_request in cursor:
            data = {
                'name': register_request[0],
                'email':register_request[1]
            }
            
            response['data'].append(data)

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

        response = {
            'data':[]
        }

        for register_request in cursor:
            data = {
                'name': register_request[0],
                'email':register_request[1]
            }
            
            response['data'].append(data)

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
def user(id):
    status = 400
    response = {}

    if request.method == 'GET':
        return 
    elif request.method == 'PATCH':
        name = request.form['name']
        surname_1 = request.form['surname_1']
        surname_2 = request.form['surname_2']
        email = request.form['email']

        cursor = mydb.cursor()
        query = f'UPDATE users SET name=\'{name}\', surname_1=\'{surname_1}\', surname_2=\'{surname_2}\', email=\'{email}\' WHERE id={id}'
        print(query, file=sys.stderr)

        cursor.execute(query)
        mydb.commit()
        cursor.close()
        
        response = 'Update User succesfully'
        status = 200

        return response, status

    elif request.method == 'DELETE':
        # cursor.mydb.cursor()
        # query = f'DELETE FROM users WHERE id={id}'
        # cursor.execute(query)
        # mydb.commit()
        # cursor.close()

        # response = 'User Deleted Succesfully'
        # status = 200
        
        # return response, status
        return
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
