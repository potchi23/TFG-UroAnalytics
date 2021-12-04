from typing import final
from flask import Flask, request, session, redirect
from urllib import parse
from mysql import connector
import requests


app = Flask(__name__)

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
            status = 200
        except TypeError as e:
            print(e)
        finally:
            cursor.close()

            response = {
                "status":status
            }
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
        database='tfg_db'
    )

    app.run()
