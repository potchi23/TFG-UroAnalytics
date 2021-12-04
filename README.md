# TFG: Predicción de datos para una unidad de urooncología
A continuación se proporciona una guía para poder iniciar el entorno y así poder probar la aplicación.

## Requisitos:
  - **Python3**
    - Si falta alguna librería (el IDE os lo dirá), podéis instalarlo desde el terminal con ```pip install <libreria>```
  - **XAMPP**. Se necesitan principalmente:
    - Apache
    - MySQL y phpMyAdmin (*Depende de si usamos MySQL como base de datos, posibilidad de cambio*)

## Descripción
Tenemos dos carpetas:
  - **Backend**: Contiene toda la lógica de la aplicación. Dentro se encuentra la REST API hecha con Flask.
  - **Frontend**: Contiene la GUI de la aplicación. Dentro se incluyen los ficheros HTML, CSS, PHP y Javascript.

Es posible que en el futuro se añada alguno más.

## Preparación del entorno
Para lanzar la aplicación, tanto el **backend** y el **frontend** deben de estar ejecutándose en algún tipo de servidor.
Se presupone que todos los requisitos mencionados en [Requisitos](#Requisitos) se cumplen.

### Preparación del backend
  1. Entrar dentro de la carpeta ```/TFG/backend```
  2. Iniciar una terminal en la carpeta ```/TFG/backend```
  3. Ejecutar el comando ```python tfg_server.py``` en Windows o Mac o ```python3 tfg_server.py``` en Linux
  4. En el navegador, entrar en ```localhost:5000``` y comprobar que devuelve algo (puede ser una página totalmente en blanco 
  o un mensaje de error lanzado por el servidor)
  
 ### Preparación del frontend
  1. Abrir XAMPP
  <br> *Nota: Si ya teneis configurado XAMPP, saltar directamente al [Paso 6](#frontend_init_apache)*
  2. Parar todos los servicios en ejecución
  3. En la columna *Actions*, entrar *Config > Apache(httpd.conf)*
  4. Buscar dentro del fichero la línea ```DocumentRoot "C:\xampp\htdocs"``` y sustituirla por ```DocumentRoot "C:\<ruta_TFG>\TFG\frontend"```
  <br>*Ejemplo*: ```DocumentRoot "C:\Users\<nombre>\Documents\GitHub\TFG\frontend"```
  5. Buscar dentro del fichero la línea ```<Directory "C:\xampp\htdocs">``` y sustituirla por ```<Directory "C:\<ruta_TFG>\TFG\frontend">```
  <br>*Ejemplo*: ```<Directory "C:\Users\<nombre>\Documents\GitHub\TFG\frontend">```
  6. Iniciar Apache<a name="frontend_init_apache"></a>
  7. En el navegador, entrar en ```localhost``` y comprobar que devuelve el contenido de ```TFG/frontend/index.php```
  
