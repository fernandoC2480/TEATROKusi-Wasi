<?php
// backend/src/auth/google_login.php
// Este archivo inicia el flujo de autenticación con Google

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

require_once __DIR__ . '/../config/google_config.php';

// Generar un token CSRF para proteger contra ataques
$_SESSION['oauth_state'] = bin2hex(random_bytes(16));

// Construir la URL de autorización de Google
$auth_url = GOOGLE_AUTH_URL . '?' . http_build_query([
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => GOOGLE_SCOPES,
    'state' => $_SESSION['oauth_state'],
    'access_type' => 'online',
    'prompt' => 'consent'
]);

// Redirigir a Google para que el usuario autorice
header('Location: ' . $auth_url);
exit;
?>
