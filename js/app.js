"use strict"
const BASE_PATH = window.location.pathname.split("/").slice(0, -2).join("/"); // Ajusta el nivel según la estructura
const BASE_URL = `${window.location.origin}${BASE_PATH}/Tpe-web-Api/api/`;

let btnInicio=document.getElementById("inicio").addEventListener("click", getAllFilm);
let btnProductoras=document.getElementById("productoras").addEventListener("click", getAllProducers);
let btnReseñas=document.getElementById("reseñas").addEventListener("click", getAllReview);
let films= [];
let film = {};
let producer = {};
let producers= [];
let review=[];

async function getAllFilm() {
    try {
        const response= await fetch( BASE_URL + "peliculas");
       
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
        const response= await fetch(BASE_URL +"productoras");
       
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
                                    <a href='#' data-id='${producer.id_productora}'class='text-decoration-none titulo text-danger  btnDetail' >${producer.nombre_productora}</a>
                                </h5>
                                <p class='card-text'>${producer.pais_origen}</p>
                        </div>
                </div>
            </div>`;
     div.innerHTML +=html;
    });
   div.innerHTML += `<p class="mt-3 text-center"><small>Mostrando ${producers.length} Productoras</small></p>`;
   const btnsDetail = document.querySelectorAll(".btnDetail");
   btnsDetail.forEach(btn => {
       btn.addEventListener('click', getProducer);
   });

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
                                    <a href='#' data-id='${film.id_peliculas}'  class='text-decoration-none titulo text-danger btnDetail'>${film.Nombre_pelicula}</a>
                                   
                                    </h5>
                                <p class='card-text'>${film.genero}</p>
                        </div>
                </div>
            </div>`;
     div.innerHTML +=html;
    
    });
   div.innerHTML += `<p class="mt-3 text-center"><small>Mostrando ${films.length} Películas</small></p>`;
   const btnsDetail = document.querySelectorAll(".btnDetail");
   btnsDetail.forEach(btn => {
       btn.addEventListener('click', getFilm);
   });

}
 async function getFilm(e) {
    try {
        e.preventDefault(); // Evita la acción predeterminada del enlace

        let id = e.currentTarget.dataset.id; 
       
        if (!id) {
            console.error("¡No se encontró el ID de la película!");
            return;
        }
        const response = await fetch(BASE_URL + "peliculas/" + id, {
            method: "GET"});
        if (!response.ok) {
            throw new Error("Error al obtener los detalles de la película.");
        }
        
        film = await response.json();
        showFilm(); // Llama a la función para mostrar los detalles de la película
        
    } catch (error) {
        console.log(error);
    }
 }
 function showFilm() {
    let div= document.getElementById("contenedorMostrar");
    div.innerHTML=" ";
    if (!film) {
        div.innerHTML = "<p>Detalles de la película no encontrados.</p>";
        return;
    }
    let html= `  
     <div class="container mt-4 informacion">
        <h1 class="mb-4">${film.Nombre_pelicula}</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Director:${film.director}</p>
                <p class="card-text"><strong>Género:</strong>${film.genero}</p>
                <p class="card-text"><strong>Idioma:</strong>${film.Idioma}</p>
                <p class="card-text"><strong>Lanzamiento:</strong>${film.Lanzamiento}</p>
                <p class="card-text"><strong>Productora:</strong>${film.Nombre_productora}</p>
            </div>
        </div>
    </div>`;
    ;
    div.innerHTML +=html;
    
 }
 async function getProducer(e) {
    try {
        e.preventDefault(); // Evita la acción predeterminada del enlace

        let id = e.currentTarget.dataset.id; 
       
        if (!id) {
            console.error("¡No se encontró el ID de la productora!");
            return;
        }
        const response = await fetch(BASE_URL + "productoras/" + id, {
            method: "GET"});
        if (!response.ok) {
            throw new Error("Error al obtener los detalles de la productora.");
        }
        
        producer = await response.json();
        showproducer(); 
        
    } catch (error) {
        console.log(error);
    }
 }
 function showproducer() {
    let div= document.getElementById("contenedorMostrar");
    div.innerHTML=" ";
    if (!producer) {
        div.innerHTML = "<p>Detalles de la productora no encontrados.</p>";
        return;
    }
    let html= `  
     <div class="container mt-5">
            <!-- Información de la productora -->
            <div class="row mt-4">
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="${producer.imagen_productora}" alt="Imagen de la productora" class="img-fluid rounded" style="max-width: 100%;">
            </div>
                <div class="col-md-8">
                    <h1 class="text-center">${producer.nombre_productora}</h1>
                    <p><strong>País:</strong>${producer.pais_origen}</p>
                    <p><strong>Año de fundación:</strong>${producer.año_fundacion}</p>
                    <p><strong>Fundadores:</strong>${producer.fundador_es}</p>
                </div>
            </div>`;
    ;
    div.innerHTML +=html;
    
 }



 async function getAllReview() {
    try {
        const response= await fetch( BASE_URL + "reseña");
       
        if(!response.ok){
            throw new Error("error al llamar get reseña");
            
        }
       review = await response.json();
       showReview();
        
    } catch (error) {
        console.log(error);
    }
}
function showReview() {
    let div= document.getElementById("contenedorMostrar");
    div.innerHTML=" ";
    if (!review) {
        div.innerHTML = "<p>Detalles de la reseña no encontrados.</p>";
        return;
    }
        review.forEach(r => {
            let html = `  
            <div class="container mt-4 informacion">
               <h1 class="mb-4">${r.usuario}</h1>
               <div class="card">
                   <div class="card-body">
                       <p class="card-text"><strong>Opinión:</strong>${r.opinion}</p>
                       <p class="card-text"><strong>Puntuación:</strong>${r.puntuacion}</p>
                       <p class="card-text"><strong>Película ID:</strong>${r.id_pelicula}</p>
                       <p class="card-text"><strong>Fecha Publicada:</strong>${r.fecha_publicado}</p>
                   </div>
               </div>
            </div>`;
            div.innerHTML += html;
        });
    }
getAllFilm();
