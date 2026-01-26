<?php
/**
 * Configuración global del proyecto
 * Define las rutas base para todo el sistema
 */

// Detectar la ruta del documento raíz
$script_name = $_SERVER['SCRIPT_NAME'];
$script_dir = dirname($script_name);

// Si estamos en /TEATROKusi-Wasi/frontend/pages/register.php
// $script_name = /TEATROKusi-Wasi/frontend/pages/register.php
// Extraer la ruta base del proyecto (TEATROKusi-Wasi o lo que sea)

// Opción 1: Si el proyecto está en una carpeta específica
if (strpos($script_name, '/TEATROKusi-Wasi/') !== false) {
    define('PROJECT_BASE', '/TEATROKusi-Wasi');
} else {
    // Opción 2: Detectar automáticamente
    $parts = explode('/', trim($script_dir, '/'));
    if (count($parts) > 0) {
        define('PROJECT_BASE', '/' . $parts[0]);
    } else {
        define('PROJECT_BASE', '');
    }
}

// Rutas de la aplicación
define('BASE_URL', PROJECT_BASE);
define('FRONTEND_URL', PROJECT_BASE . '/frontend');
define('BACKEND_URL', PROJECT_BASE . '/backend');
define('AUTH_URL', PROJECT_BASE . '/backend/src/auth');

// Variable para usar en formularios
$auth_action = BASE_URL . '/backend/src/auth/';
?>
