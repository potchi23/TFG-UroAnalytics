import sys
from flask import Flask, request, Response
from mysql import connector
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route('/login', methods=['GET','POST','PUT','DELETE'])
def index():
    if request.method == 'GET':
        return
    elif request.method == 'POST':
        # Cambiad todo esto, es de una prueba de concepto

        email = request.form['email']
        password = request.form['password']

        cursor = mydb.cursor()
        cursor.execute('SELECT email FROM users')
        result = cursor.fetchall()

        for x in result:
            email = x[0]

        return {'email':email, 'password':password}, 200
    elif request.method == 'PUT':
        return
    elif request.method == 'DELETE':
        return
    else:
        return 'Method not supported', 400

@app.route('/register', methods=['POST'])
def register():
    status = 400
    if request.method == 'POST':
        name = request.form['name']
        surname_1 = request.form['surname_1']
        surname_2 = request.form['surname_2']
        email = request.form['email']
        password = request.form['password']

        cursor = mydb.cursor()
        query = "INSERT INTO users(name, surname_1, surname_2, email, password) VALUES (%s,%s,%s,%s,%s)"
        values = (name, surname_1, surname_2, email, password)
        
        try:
            cursor.execute(query, values)
            mydb.commit()
            status = 201
        except TypeError as e:
            print(e, file=sys.stderr)
        finally:
            cursor.close()

            response = {
                "status":status
            }
            return response, status

    else:
        return 'Method not supported', status

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
        query = f'UPDATE users SET accepted = 1 WHERE id = {user_id}'
        cursor.execute(query)
        mydb.commit()
        cursor.close()

        response = Response()
        status = 204

        return response, status

    elif request.method == 'DELETE':
        cursor = mydb.cursor()
        user_id = request.form['id']
        query = f'DELETE FROM users WHERE id = {user_id}'
        cursor.execute(query)
        mydb.commit()
        cursor.close()

        response = Response()
        status = 204

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
