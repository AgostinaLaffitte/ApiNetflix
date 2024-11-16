<?php
    function verifyAuthMiddleware($res) {
        if (!isset($res->user)) { // Verificar si el usuario no está autenticado
            header('Location: ' . BASE_URL . 'showLogin');
            exit();
        }
    }
    
?>