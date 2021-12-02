from flask import Flask, request, session, redirect
from urllib import parse
import requests

app = Flask(__name__)

@app.route('/', methods=['GET','POST','PUT','DELETE'])
def index():
    if request.method == 'GET':
        return
    elif request.method == 'POST':
        email = request.form["email"]
        password = request.form["password"]
        return {"email":email, "password":password}, 200
    elif request.method == 'PUT':
        return
    elif request.method == 'DELETE':
        return
    else:
        return "Method not supported"


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
    app.run()
