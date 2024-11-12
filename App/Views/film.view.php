<?php

class FilmsView {

    public $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showFilms($films, $producers) {
        // La vista define una nueva variable con la cantidad de peliculas.
        $count = count($films);
        
        require 'Templates/Films/list_films.phtml';
    }

    public function showError($error) {
        require 'Templates/error.phtml';
    }

    public function showHome($films) {
        require 'Templates/Films/home_films.phtml';
    }
    
    public function showFilmDetails($film, $films) {
        require 'Templates/Films/film_details.phtml';
    }
  
    public function showEditFilmForm($film, $producers) {
        require 'Templates/Films/form_edit_film.phtml';
    }

}
