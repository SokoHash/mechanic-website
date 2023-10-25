# Django Mecanic project server side

## Instalacion

Clonar repositorio
### git clone https://github.com/SokoHash/mechanic-website

Ir al servidor
### cd mechanic-website\server

Si no tienes el modulo
### `pip install virtualenv`

Primero, crear un entorno virtual:
### `python -m virtualenv env`

Para ingresar al entorno virtual
### `.\env\Scripts\activate`

Para instalar los paquetes necesarios:
### `pip install -r requirements.txt`

Para iniciar el servidor:
### `python manage.py runserver`


----------------------
------------
-------------
---------------
# REST API Doc

## Metodos Admin/login

##Las credenciales de admin y pass son:
aurora@run.com
123456789

### Request POST

`POST /usuario/`

    http://127.0.0.1:8000/api/login/
### Parameters
    {
    "email": "test@run.com",
    "id_card": "6548125",
    "phone": 325489,
    "password": "123456789"
    }
### Response
Si es admin

    {
    "message": "admin",
    "adminvalue": "23b26112-3b2f-4e4d-ba2f-fa1a2bddc7da"
    }

Si es usuario

    {
    "message": "user",
    "uservalue": "5e50d1d2-8667-4daf-a0c4-024a62269e12"
    }
----------------------
------------
-------------
---------------

### Request POST

`POST /search/<str:token>`

Retorna datos del usuario usando el token del admin

    http://127.0.0.1:8000/api/search/<str:token>
### Parameters
    {
    "email": "test@run.com"
    }
### Response
    {
    "uservalue": [
    {
    "id": 10,
    "email": "test@run.com",
    "id_card": "6548125",
    "phone": 325489,
    "password": "pbkdf2_sha256$600000$SpoggTMqy6uV4achwpp44x$jb9GZMZf4ZLfdB+ZCr7E4Kxg5jytWhTjJxERD+s0bdA=",
    "token_user": "7d0e0c47-366c-46d8-a7bb-793db836ccde",
    "is_admin": false
    }
    ]
    }

----------------------
------------
-------------
---------------


## Metodos usuario

### Request POST

`POST /usuario/`

    http://127.0.0.1:8000/api/usuario/
### Parameters
    {
    "email": "test@run.com",
    "id_card": "6548125",
    "phone": 325489,
    "password": "123456789"
    }
### Response

    {'message': "Success"}

----------------------
------------
-------------
---------------
### Request GET

`GET /usuario/<str:token>`

    http://127.0.0.1:8000/api/usuario/<str:token>
### Parameters

### Response
    {
    "message": "Success",
    "uservalue":
    {
    "id": 9,
    "email": "aurora@run.com",
    "id_card": "6548125",
    "phone": 325489,
    "password": "pbkdf2_sha256$600000$dgn03OaD0j6V6CXZrxOapV$+hguMmtzhi4E2zuSM5xBy88Ax6h5ugGDYO7t8dAQXRk=",
    "token_user": "93dc89ce-c715-4b1b-9990-d3a7a7eb521c",
    "is_admin": false
    }
    }
----------------------
------------
-------------
---------------
### Request PUT

`PUT /usuario/<str:token>`

    http://127.0.0.1:8000/api/usuario/<str:token>
### Parameters
    {
    "email": "test2@example.com",
    "id_card": "123454879",
    "phone": 22322323,
    "password": "12345678"
    }
### Response
    {"message": "Success"}

----------------------
------------
-------------
---------------
### Request DELETE

`DELETE /usuario/<str:token>`

    http://127.0.0.1:8000/api/usuario/<str:token>
### Parameters

### Response
    {"message": "Success"}
----------------------
------------
-------------
---------------

## Metodos vehiculo

### Request POST

`POST /usuario/<str:token>`

    http://127.0.0.1:8000/api/vehicle/<str:token>
### Parameters
    {
    "placa": "950-Myanmar",
    "vehiculo": "Chevrolet adams 2015",
    "tipo_arreglo": "Restauracion de fuga de gas",
    "description": "Limpieza y mantenimiento de la fuga de gas, se encontraron varios errores",
    "mecanico": "Juan Carlos"
    }
### Response
    {"message": "Success"}
----------------------
------------
-------------
---------------
### Request GET

`GET vehicle/<str:token>/`

    http://127.0.0.1:8000/api/vehicle/<str:token>/
### Parameters

### Response
    {
    "uservalue": [
    {
    "id": 5,
    "placa": "950-Myanmar",
    "vehiculo": "Chevrolet adams 2015",
    "tipo_arreglo": "Restauracion de fuga de gas",
    "description": "Limpieza y mantenimiento de la fuga de gas, se encontraron varios errores",
    "mecanico": "Juan Carlos",
    "userfk_id": 9
    }
    ]
    }
----------------------
------------
-------------
---------------
### Request GET by placa

`GET searchvehicle/<str:token>/<str:placa>`

    http://127.0.0.1:8000/api/searchvehicle/<str:token>/<str:placa>
### Parameters

### Response
    {
    "uservalue": [
    {
    "id": 5,
    "placa": "950-Myanmar",
    "vehiculo": "Chevrolet adams 2015",
    "tipo_arreglo": "Restauracion de fuga de gas",
    "description": "Limpieza y mantenimiento de la fuga de gas, se encontraron varios errores",
    "mecanico": "Juan Carlos",
    "userfk_id": 9
    }
    ]
    }
----------------------
------------
-------------
---------------
### Request PUT

`PUT vehicle/<str:token>/<str:placa>`

    http://127.0.0.1:8000/api/vehicle/<str:token>/<str:placa>
### Parameters
    {
    "placa": "859-ety",
    "vehiculo": "Ferrari minamar 2052",
    "tipo_arreglo": "Carroceria",
    "description": "Limpieza y mantenimiento de motor",
    "mecanico": "Carlos Felipe"
    }
### Response
    {"message": "Success"}

----------------------
------------
-------------
---------------
### Request DELETE

`DELETE vehicle/<str:token>/<str:placa>`

    http://127.0.0.1:8000/api/vehicle/<str:token>/<str:placa>
### Parameters

### Response
    {"message": "Success"}
