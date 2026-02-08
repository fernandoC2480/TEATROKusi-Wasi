<?php
// Configuración de Google OAuth

// IMPORTANTE: Obtén estas credenciales en https://console.cloud.google.com/
// 1. Crea un proyecto en Google Cloud Console
// 2. Habilita Google+ API
// 3. Crea credenciales OAuth 2.0 (tipo Web Application)
// 4. Reemplaza los valores abajo

define('GOOGLE_CLIENT_ID', 'TU_GOOGLE_CLIENT_ID.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'TU_GOOGLE_CLIENT_SECRET');
define('GOOGLE_REDIRECT_URI', 'http://localhost/TEATROKusi-Wasi/backend/src/auth/google_callback.php');

// Para producción, usa:
// define('GOOGLE_REDIRECT_URI', 'https://tudominio.com/backend/src/auth/google_callback.php');

?>
