"use strict"
let btnInicio=document.getElementById("inicio").addEventListener("click", getAllFilm);
let btnProductoras=document.getElementById("productoras").addEventListener("click", getAllProducers);
let films= [];
let producers= [];
async function getAllFilm() {
    try {
        const response= await fetch("http://localhost/web2/Tpe-web-Api/api/peliculas");
       
        if(!response.ok){
            throw new Error("error al llamar get film");
            
        }
       films= await response.json();
       showFilms();
        
    } catch (error) {
        console.log(error);
    }
}
async function getAllProducers() {
    try {
        const response= await fetch("http://localhost/web2/Tpe-web-Api/api/productoras");
       
        if(!response.ok){
            throw new Error("error al llamar get productoras");
            
        }
       producers= await response.json();
       showProducers();
        
    } catch (error) {
        console.log(error);
    }
}
function showProducers(){
    let div= document.getElementById("contenedorMostrar");
    div.innerHTML=" ";
    producers.forEach(producer => {
    let html= ` <div class="col-md-4 mb-4">
                    <div class='card'>
                        <div class='film-image' style='height: 200px; background-color: #f0f0f0; border: 5px solid black;'>
                            <img src=${producer.imagen_productora} alt=${producer.nombre_productora} class='card-img-top' style='height: 100%; object-fit: cover;'>
                        </div>
                        <div class='card-body'>
                                <h5 class='card-title'>
                                    <a href='pelicula/'${producer.id_productora} class='text-decoration-none titulo text-danger'>${producer.nombre_productora}</a>
                                </h5>
                                <p class='card-text'>${producer.pais_origen}</p>
                        </div>
                </div>
            </div>`;
     div.innerHTML +=html;
    });
   div.innerHTML += `<p class="mt-3 text-center"><small>Mostrando ${producers.length} Productoras</small></p>`;
  

}
function showFilms(){
    let div= document.getElementById("contenedorMostrar");
    div.innerHTML=" ";
    films.forEach(film => {
    let html= ` <div class="col-md-4 mb-4">
                    <div class='card'>
                        <div class='film-image' style='height: 200px; background-color: #f0f0f0; border: 5px solid black;'>
                            <img src=${film.imagen_pelicula} alt=${film.Nombre_pelicula} class='card-img-top' style='height: 100%; object-fit: cover;'>
                        </div>
                        <div class='card-body'>
                                <h5 class='card-title'>
                                    <a href='pelicula/'${film.id_peliculas} class='text-decoration-none titulo text-danger'>${film.Nombre_pelicula}</a>
                                </h5>
                                <p class='card-text'>${film.genero}</p>
                        </div>
                </div>
            </div>`;
     div.innerHTML +=html;
    });
   div.innerHTML += `<p class="mt-3 text-center"><small>Mostrando ${films.length} Películas</small></p>`;
  

}
getAllFilm();