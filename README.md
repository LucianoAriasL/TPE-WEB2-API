# API REST para el recurso de zapatillas
Una API REST sencilla para manejar un CRUD de zapatillas

## Importar la base de datos
- importar desde PHPMyAdmin (o cualquiera) database/tienda_de_zapatillas.sql


## Pueba con postman
El endpoint de la API es: http://localhost/TPE-WEB2-API/api/zapatillas

   | Method | Url | Code | Default Response |
   |-:|--|:-:|:-|
   | GET | /zapatillas | 200 | Array<zapatillas> |
   | GET | /zapatillas/:ID | 200 | zapatilla |
   | POST | /zapatillas | 201 | zapatilla |
   | DELETE | /zapatillas/:ID | 200 | zapatilla |

## SELECCIONAR DATOS A MOSTRAR
    Agregar query params a la solicitud GET:
    - /zapatillas?select=nombre

## ORDENAMIENTO
    Agregar query params a la solicitud GET:
    - /zapatillas?orderBy=precio&orderMode=asc
    - Nota: si omite alguno de los parametros, el ordenamiento sera como viene de la tabla

## PAGINACION
    Agregar query params a la solicitud GET:
    - /zapatillas?startAt=0&endAt=4

## FILTRADO
    Agregar query params a la solicitud GET:
    - /zapatillas?linkTo=marca&equalTo=Nike - Busca en el campo marca la cadena Nike



