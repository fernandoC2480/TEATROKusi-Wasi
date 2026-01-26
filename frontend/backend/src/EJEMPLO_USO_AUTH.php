<?php
// EJEMPLO: Cómo usar la autenticación en tus páginas

// Método 1: Verificar si el usuario está logueado
require_once '../../backend/src/config/auth_helper.php';

if (isUserLoggedIn()) {
    echo "Bienvenido, " . getCurrentUserName();
    echo "Tu email es: " . getCurrentUserEmail();
    
    if (isGoogleAuthenticated()) {
        echo "Te has autenticado con Google";
    }
} else {
    echo "Por favor, inicia sesión primero";
}

// Método 2: Requerir login obligatorio para acceder a la página
require_once '../../backend/src/config/auth_helper.php';
requireLogin();
// Código aquí solo se ejecuta si está autenticado

// Método 3: Requerir un rol específico
require_once '../../backend/src/config/auth_helper.php';
requireRole('admin'); // O requireRole(['admin', 'moderador']);
// Código aquí solo se ejecuta si tiene el rol requerido

// Método 4: Mostrar botón de logout si está autenticado
require_once '../../backend/src/config/auth_helper.php';

if (isUserLoggedIn()) {
    echo '<a href="../../backend/src/auth/logout.php">Cerrar Sesión</a>';
}

?>
