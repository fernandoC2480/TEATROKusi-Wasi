<?php
// backend/src/config/auth_helper.php
// Funciones de utilidad para manejo de autenticación

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

/**
 * Verifica si el usuario está autenticado
 * @return bool
 */
function isUserLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Obtiene el ID del usuario autenticado
 * @return int|null
 */
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Obtiene el nombre del usuario autenticado
 * @return string|null
 */
function getCurrentUserName() {
    return $_SESSION['user_name'] ?? null;
}

/**
 * Obtiene el email del usuario autenticado
 * @return string|null
 */
function getCurrentUserEmail() {
    return $_SESSION['user_email'] ?? null;
}

/**
 * Obtiene el rol del usuario autenticado
 * @return string|null
 */
function getCurrentUserRole() {
    return $_SESSION['user_rol'] ?? null;
}

/**
 * Verifica si el usuario fue autenticado mediante Google OAuth
 * @return bool
 */
function isGoogleAuthenticated() {
    return isset($_SESSION['google_auth']) && $_SESSION['google_auth'] === true;
}

/**
 * Redirige a login si no está autenticado
 * @param string $redirect_page URL a redirigir tras login exitoso
 */
function requireLogin($redirect_page = null) {
    if (!isUserLoggedIn()) {
        header("Location: /TEATROKusi-Wasi/frontend/pages/loging.php?redirect=" . urlencode($redirect_page ?? $_SERVER['REQUEST_URI']));
        exit;
    }
}

/**
 * Redirige a login si no tiene el rol especificado
 * @param string|array $required_roles Role(s) requerido(s)
 */
function requireRole($required_roles) {
    if (!isUserLoggedIn()) {
        header("Location: /TEATROKusi-Wasi/frontend/pages/loging.php");
        exit;
    }
    
    $current_role = getCurrentUserRole();
    $roles_array = is_array($required_roles) ? $required_roles : [$required_roles];
    
    if (!in_array($current_role, $roles_array)) {
        http_response_code(403);
        echo "Acceso denegado. Requiere rol: " . implode(", ", $roles_array);
        exit;
    }
}

?>
