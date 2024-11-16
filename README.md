# ApiNetflix

## Películas

### Obtener lista de películas
Endpoint: GET /peliculas
Descripción: Devuelve una lista de todas las películas.
Obtener detalles de una película
Endpoint: GET /peliculas/:id
Descripción: Devuelve los detalles de una película específica.

### Agregar una película
Endpoint: POST /peliculas
Descripción: Permite agregar una nueva película.
Cuerpo de la solicitud en formato json:
{
  "nombre": "string",
  "año": "int",
  "director": "string"
}

### Eliminar una película
Endpoint: DELETE /peliculas/:id
Descripción: Elimina una película existente.

### Editar una película
Endpoint: PUT /peliculas/:id
Descripción: Actualiza los datos de una película existente.
Cuerpo de la solicitud en formato json:
{
  "nombre": "string",
  "año": "int"
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
  "nombre": "string",
  "fundada": "int"
}

### Eliminar una productora
Endpoint: DELETE /productoras/:id
Descripción: Elimina una productora existente.

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

