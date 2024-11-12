<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'Templates/form_login.phtml';
    }

    public function showError($error) {
        require 'Templates/error.phtml';
    }

}