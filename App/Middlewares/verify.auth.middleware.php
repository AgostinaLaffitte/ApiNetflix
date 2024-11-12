<?php
    function verifyAuthMiddleware($res) {
        if (!isset($res->user)) { // Verificar si el usuario no está autenticado
            header('Location: ' . BASE_URL . 'showLogin');
            exit(); // Terminar el script después de la redirección
        }
        // Si el usuario está autenticado, no se necesita hacer nada
    }
    
?>