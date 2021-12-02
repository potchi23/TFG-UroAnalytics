from flask import Flask, request, session, redirect
from urllib import parse
import requests
# Resto de importaciones


app = Flask(__name__)

@app.route('/index', methods=['GET'])
def index():
    return "Hello World!", 200
     
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
