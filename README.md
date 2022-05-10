# TFG: Predicción de datos para una unidad de urooncología
*Autores: Laura González Falque ([@laurafalque14](https://github.com/laurafalque14)), Mariana de la Caridad Villar Rojas ([@marianavillar](https://github.com/marianavillar)), Maryny Zara Castada Collado ([@marynyzcc](https://github.com/marynyzcc)), Mateo González de Miguel ([@matgon](https://github.com/matgon)) y Richard Junior Mercado Correa ([@potchi23](https://github.com/potchi23/))*

## Requisitos<a name="requisitos"></a>:
  - [**Python3**](https://www.python.org/downloads/)
    - Si falta alguna librería (el IDE y el terminal os lo dirá), podéis instalarlo desde el terminal con ```pip install <libreria>```.
    Otra opción es entrar en la carpeta ```TFG/src/backend``` y ejecutar ```pip install -r requirements.txt``` para instalar
    todas las dependencias del backend.
  - [**XAMPP**](https://www.apachefriends.org/download.html)
    <br>Se necesitan principalmente:
    - **Apache**
    - **MySQL** y **phpMyAdmin**
## Descripción
En ```src``` se encuentra el código del proyecto. Tenemos tres carpetas:
  - ```backend```: Contiene toda la lógica de la aplicación. Dentro se encuentra la REST API hecha con Flask. Tambien se encuentra el
                   fichero ```requirements.txt``` con las dependencias necesarias para nuestro servidor.
  - ```frontend```: Contiene la GUI de la aplicación. Dentro se incluyen los ficheros HTML, CSS, PHP y Javascript.
  - ```sql```: Contiene un fichero con la base de datos. Se puede **importar** directamente en **phpMyAdmin**.

**Importante**: El servidor de Flask solo funciona si **MySQL está en ejecución**. Arrancar primero MySQL antes de iniciar Flask.

## Preparación del entorno
Para lanzar la aplicación, tanto el **backend** como el **frontend** deben de estar ejecutándose en algún tipo de servidor.
Se presupone que todos los requisitos mencionados en [Requisitos](#requisitos) se cumplen.

### Preparación del backend
  1. Entrar dentro de la carpeta ```TFG/src/backend```
  2. Iniciar una terminal en la carpeta ```TFG/src/backend```
  3. Ejecutar el comando ```pip install -r requirements.txt``` para instalar las dependencias del servidor
  4. Ejecutar el comando ```python tfg_server.py``` en Windows o Mac o ```python3 tfg_server.py``` en Linux
  5. En el navegador, entrar en ```localhost:5000``` y comprobar que devuelve ```{ "message" : "Server is running" }```
  
 ### Preparación del frontend
  1. Abrir XAMPP
  <br> *Nota: Si ya teneis configurado XAMPP, saltar directamente al [Paso 6](#frontend_init_apache)*
  2. Parar todos los servicios en ejecución
  3. En la columna *Actions*, entrar *Config > Apache(httpd.conf)*
  4. Buscar dentro del fichero la línea ```DocumentRoot "C:\xampp\htdocs"``` y sustituirla por ```DocumentRoot "C:\<ruta_TFG>\TFG\src\frontend"```<a name="frontend_document_root"></a>
  <br>*Ejemplo*: ```DocumentRoot "C:\Users\<nombre>\Documents\GitHub\TFG\src\frontend"```
  5. Buscar dentro del fichero la línea ```<Directory "C:\xampp\htdocs">``` y sustituirla por ```<Directory "C:\<ruta_TFG>\TFG\src\frontend">```<a name="frontend_directory"></a>
  <br>*Ejemplo*: ```<Directory "C:\Users\<nombre>\Documents\GitHub\TFG\src\frontend">```
  6. Iniciar Apache<a name="frontend_init_apache"></a>
  7. En el navegador, entrar en ```localhost``` o en ```localhost:80``` y comprobar que devuelve el contenido de ```TFG/src/frontend/index.php```
 
