# TFG: Predicción de datos para una unidad de urooncología
A continuación se proporciona una guía para poder iniciar el entorno y así poder probar la aplicación.

## Requisitos:
  - [**Python3**](https://www.python.org/downloads/)
    - Si falta alguna librería (el IDE os lo dirá), podéis instalarlo desde el terminal con ```pip install <libreria>```
  - [**XAMPP**](https://www.apachefriends.org/download.html)
    <br>Se necesitan principalmente:
    - Apache
    - MySQL y phpMyAdmin (*Depende de si usamos MySQL como base de datos, posibilidad de cambio*)

## Descripción
En ```src``` se encuentra el código del proyecto. Tenemos dos carpetas:
  - **Backend**: Contiene toda la lógica de la aplicación. Dentro se encuentra la REST API hecha con Flask
  - **Frontend**: Contiene la GUI de la aplicación. Dentro se incluyen los ficheros HTML, CSS, PHP y Javascript
  - **SQL**: Contiene un fichero con la base de datos. Se puede **importar** directamente en **phpMyAdmin**

En ```resources``` de momento hay un esquema básico de la estructura del proyecto



Es posible que en el futuro se añada alguno más.

## Preparación del entorno
Para lanzar la aplicación, tanto el **backend** y el **frontend** deben de estar ejecutándose en algún tipo de servidor.
Se presupone que todos los requisitos mencionados en [Requisitos](#Requisitos) se cumplen.

### Preparación del backend
  1. Entrar dentro de la carpeta ```TFG/src/backend```
  2. Iniciar una terminal en la carpeta ```TFG/src/backend```
  3. Ejecutar el comando ```python tfg_server.py``` en Windows o Mac o ```python3 tfg_server.py``` en Linux
  4. En el navegador, entrar en ```localhost:5000``` y comprobar que devuelve algo (puede ser una página totalmente en blanco 
  o un mensaje de error lanzado por el servidor)
  
 ### Preparación del frontend
  1. Abrir XAMPP
  <br> *Nota: Si ya teneis configurado XAMPP, saltar directamente al [Paso 6](#frontend_init_apache)*
  2. Parar todos los servicios en ejecución
  3. En la columna *Actions*, entrar *Config > Apache(httpd.conf)*
  4. Buscar dentro del fichero la línea ```DocumentRoot "C:\xampp\htdocs"``` y sustituirla por ```DocumentRoot "C:\<ruta_TFG>\TFG\src\frontend"```<a name="frontend_document_root"></a>
  <br>*Ejemplo*: ```DocumentRoot "C:\Users\<nombre>\Documents\GitHub\TFG\src\frontend"```
  5. Buscar dentro del fichero la línea ```<Directory "C:\xampp\htdocs">``` y sustituirla por ```<Directory "C:\<ruta_TFG>\TFG\src\frontend">```<a name="frontend_directory">
  <br>*Ejemplo*: ```<Directory "C:\Users\<nombre>\Documents\GitHub\TFG\src\frontend">```
  6. Iniciar Apache<a name="frontend_init_apache"></a>
  7. En el navegador, entrar en ```localhost``` o en ```localhost:80``` y comprobar que devuelve el contenido de ```TFG/src/frontend/index.php```

 Si despues de seguir los pasos anteriores no conseguis conectar con ```localhost``` ni con ```localhost:80```, revisad que habeis escrito bien las lineas de los pasos [4](#frontend_document_root)
 y [5](#frontend_directory), y reiniciad Apache. Si aun así no se conecta, mirar la [Configuración de puertos de Apache](#configuracion_puertos).
  
 #### Configuración de puertos de Apache<a name="configuracion_puertos"></a>
  1. Parar Apache
  2. En la columna *Actions*, entrar *Config > Apache(httpd.conf)*
  3. Buscar la línea ```Listen 80``` y cambirala por ```Listen 2000```
  4. Buscar la línea ```ServerName localhost:80``` y cambiarla por ```ServerName localhost:2000```
  5. En XAMPP, en la columna con botones a la derecha del todo, entrar en ```Config > Service and Port Settings```
  6. Cambiar el Main Port de 80 a 2000
  7. Guardar y reiniciar Apache
  7. En el navegador, entrar en ```localhost:2000``` y comprobar que devuelve el contenido de ```TFG/frontend/src/index.php```
  
  
