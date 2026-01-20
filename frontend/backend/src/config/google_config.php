<?php
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// Configuración de Google OAuth 2.0
// IMPORTANTE: Obtén estas credenciales en https://console.cloud.google.com/

// Reemplaza con tus credenciales de Google Cloud Console
define('GOOGLE_CLIENT_ID', '402918943873-mauh39h2i3e832l9b744gp518hlm99pc.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');

// URL de redirección - DEBE SER IDÉNTICA A LA DE GOOGLE CLOUD CONSOLE
define('GOOGLE_REDIRECT_URI', 'http://localhost/backend/src/auth/google_callback.php');

// URL de API de Google
define('GOOGLE_AUTH_URL', 'https://accounts.google.com/o/oauth2/v2/auth');
define('GOOGLE_TOKEN_URL', 'https://www.googleapis.com/oauth2/v4/token');
define('GOOGLE_USERINFO_URL', 'https://www.googleapis.com/oauth2/v1/userinfo');

// Alcances (scopes) solicitados a Google
define('GOOGLE_SCOPES', 'openid email profile');

?>
