# ApiNetflix

## Integrantes
Federico Poupeau Crego
Agostina Laffitte

## Películas

### Obtener lista de películas
Endpoint: GET /peliculas
Tambien puedes Obtenerlas filtradas por id de productoras: peliculas?id_productora=3
Tambien puedes filtrar por cualquiera de sus campos seas ascendente o descendete ej: peliculas?campo=Nombre_pelicula&order=asc
Descripción: Devuelve una lista de las películas.

### Obtener detalles de una película
Endpoint: GET /peliculas/:id
Descripción: Devuelve los detalles de una película específica.

### Agregar una película
REQUIERE AUTH
Endpoint: POST /peliculas
Descripción: Permite agregar una nueva película.
Cuerpo de la solicitud en formato json:
{
  "Nombre_pelicula": "xxx",
  "Lanzamiento": "xxx",
  "director": "xxx",
  "genero": "xxxx",
  "Idioma": "xxxx",
  "id_productora": "xxx"
}

### Eliminar una película
REQUIERE AUTH
Endpoint: DELETE /peliculas/:id
Descripción: Elimina una película existente.

### Editar una película
REQUIERE AUTH
Endpoint: PUT /peliculas/:id
Descripción: Actualiza los datos de una película existente.
Cuerpo de la solicitud en formato json:
{
  "Nombre_pelicula": "xxx",
  "Lanzamiento": "xxx",
  "director": "xxx",
  "genero": "xxxx",
  "Idioma": "xxxx",
  "id_productora": "xxx"
}

## Productoras

### Obtener lista de productoras
Endpoint: GET /productoras
Tambien puedes Obtenerlas filtradas porsus campos nombre_productora,fundador_es y pais_origen
Descripción: Devuelve una lista de todas las productoras.


### Obtener detalles de una productora
Endpoint: GET /productoras/:id
Descripción: Devuelve los detalles de una productora específica.

### Agregar una productora
REQUIERE AUTH
Endpoint: POST /productoras
Descripción: Permite agregar una nueva productora.
Cuerpo de la solicitud en formato json:
{
  "nombre_productora": "xxxx",
  "año_fundacion": "xxxx",
  "fundador_es": "xxx",
  "pais_origen": "xxx"
}


### Eliminar una productora
REQUIERE AUTH
Endpoint: DELETE /productoras/:id
Descripción: Elimina una productora existente.

### Editar una productora
REQUIERE AUTH
Endpoint: PUT /productora/:id
Descripción: Actualiza los datos de una película existente.
Cuerpo de la solicitud en formato json:
{
  "nombre_productora": "xxxx",
  "año_fundacion": "xxxx",
  "fundador_es": "xxx",
  "pais_origen": "xxx"
}

## Reseñas
Obtener reseñas
Endpoint: GET /reseña
Descripción: Devuelve todas las reseñas de películas.
Estas mismas se pueden ordenar por todos sus campos ej:
/reseña?orderBy=opinion /reseña?orderBy=puntuacion

### Obtener detalles de una reseña
Endpoint: GET /reseña/:id
Descripción: Devuelve los detalles de una película específica.

### Agregar una reseña
REQUIERE AUTH
Endpoint: POST /reseña
Descripción: Permite agregar una nueva reseña.
Cuerpo de la solicitud en formato json:
    {  
        "usuario": "xxx",
        "opinion": "xxxxxx",
        "puntuacion": x,
        "id_pelicula": x,
        "fecha_publicado": "xxxx-xx-xx"
    }

### Eliminar una reseña
REQUIERE AUTH
Endpoint: DELETE /reseña/:id
Descripción: Elimina una reseña existente.

### Editar una reseña
REQUIERE AUTH
Endpoint: PUT /peliculas/:id
Descripción: Actualiza los datos de una película existente.
Cuerpo de la solicitud en formato json:
{
    "usuario": "xxx",
    "opinion": "xxxxxx",
    "puntuacion": x,
    "id_pelicula": x
 }

### Usuarios
Obtener token de autenticación
Endpoint: GET /usuarios/token

Iniciar sesión :

  Nombre de usuario :webadmin@gmail.com
  Contraseña :admin
  
descripcion: Genera un token JWT para autenticar futuras solicitudes. formato Base6(usuario:contraseña).

### frontend
Hicimos un frontend muy básico que consume la api, solo lista todas las peliculas,productoras,reseñas y tambien de las peliculas yproductoras muestra sus detalles especificos.
