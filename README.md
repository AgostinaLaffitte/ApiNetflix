# ApiNetflix

## Películas

### Obtener lista de películas
Endpoint: GET /peliculas
Tambien puedes Obtenerlas filtradas por id de productoras: peliculas?id_productora=3
Descripción: Devuelve una lista de todas las películas.

### Obtener detalles de una película
Endpoint: GET /peliculas/:id
Descripción: Devuelve los detalles de una película específica.

### Agregar una película
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
Endpoint: DELETE /peliculas/:id
Descripción: Elimina una película existente.

### Editar una película
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
Productoras

### Obtener lista de productoras
Endpoint: GET /productoras
Descripción: Devuelve una lista de todas las productoras.

### Obtener detalles de una productora
Endpoint: GET /productoras/:id
Descripción: Devuelve los detalles de una productora específica.

### Agregar una productora
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
Endpoint: DELETE /productoras/:id
Descripción: Elimina una productora existente.

### Editar una productora
Endpoint: PUT /productora/:id
Descripción: Actualiza los datos de una película existente.
Cuerpo de la solicitud en formato json:
{
  "nombre_productora": "xxxx",
  "año_fundacion": "xxxx",
  "fundador_es": "xxx",
  "pais_origen": "xxx"
}

### Reseñas
Obtener reseñas
Endpoint: GET /reseña
Descripción: Devuelve todas las reseñas de películas.
Estas mismas se pueden ordenar por puntuacion o opinion
/reseña?orderBy=opinion /reseña?orderBy=puntuacion

### Usuarios
Obtener token de autenticación
Endpoint: GET /usuarios/token
Descripción: Genera un token JWT para autenticar futuras solicitudes.

