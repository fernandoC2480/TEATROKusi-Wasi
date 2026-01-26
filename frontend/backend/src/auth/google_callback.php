<?php
// backend/src/auth/google_callback.php
// Este archivo recibe el código de Google y lo intercambia por un token

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// Verificar que los archivos de configuración existan
$config_path = __DIR__ . '/../config/google_config.php';
$database_path = __DIR__ . '/../config/database.php';

if (!file_exists($config_path)) {
    http_response_code(500);
    die("Error: No se encuentra google_config.php en " . $config_path);
}

if (!file_exists($database_path)) {
    http_response_code(500);
    die("Error: No se encuentra database.php en " . $database_path);
}

require_once $config_path;
require_once $database_path;

// Ruta para redirigir si hay error
$login_page = "/pages/loging.php";

try {
    // DEBUG: mostrar variables para diagnosticar
    error_log("Google Callback - State: " . ($_GET['state'] ?? 'no recibido'));
    error_log("Google Callback - Code: " . ($_GET['code'] ?? 'no recibido'));
    error_log("Google Callback - Session State: " . ($_SESSION['oauth_state'] ?? 'no existe'));
    
    // Verificar token CSRF
    if (!isset($_GET['state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
        throw new Exception("Token de seguridad inválido");
    }

    // Verificar que Google devolvió un código
    if (!isset($_GET['code'])) {
        throw new Exception("No se recibió código de autorización de Google");
    }

    $code = $_GET['code'];

    // Intercambiar el código por un token de acceso
    $token_data = [
        'client_id' => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'code' => $code,
        'grant_type' => 'authorization_code',
        'redirect_uri' => GOOGLE_REDIRECT_URI
    ];

    $ch = curl_init(GOOGLE_TOKEN_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        throw new Exception("Error al comunicarse con Google");
    }

    $token_response = json_decode($response, true);

    if (isset($token_response['error'])) {
        error_log("Error de Google: " . json_encode($token_response));
        throw new Exception("Error de Google: " . ($token_response['error_description'] ?? $token_response['error']));
    }

    if (!isset($token_response['access_token'])) {
        throw new Exception("No se recibió token de acceso");
    }

    // Obtener información del usuario
    $access_token = $token_response['access_token'];

    $ch = curl_init(GOOGLE_USERINFO_URL . '?access_token=' . $access_token);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $access_token
    ]);

    $user_info_response = curl_exec($ch);
    curl_close($ch);

    if (!$user_info_response) {
        throw new Exception("Error al obtener información del usuario");
    }

    $google_user = json_decode($user_info_response, true);

    if (isset($google_user['error'])) {
        throw new Exception("Error al obtener datos del usuario: " . $google_user['error']);
    }

    // Procesar datos del usuario de Google
    $google_id = $google_user['id'];
    $email = $google_user['email'];
    $nombre = $google_user['name'] ?? '';
    $picture = $google_user['picture'] ?? '';

    // Conectar a la base de datos
    $database = new Database();
    $conn = $database->getConnection();
    
    // Verificar que la conexión fue exitosa
    if ($conn === null) {
        throw new Exception("No se pudo conectar a la base de datos. Verifica que MySQL esté corriendo.");
    }

    // Buscar si el usuario ya existe en nuestra base de datos
    $stmt = $conn->prepare("SELECT id, nombre, email, rol FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Usuario existe: actualizar su información y hacer login
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ? WHERE email = ?");
        $stmt->execute([$nombre, $email]);
    } else {
        // Usuario nuevo: crear cuenta automáticamente
        // Generar una contraseña aleatoria (no se usará porque solo usa OAuth)
        $random_password = bin2hex(random_bytes(16));
        $hashed_password = password_hash($random_password, PASSWORD_BCRYPT);
        
        // Insertar nuevo usuario con rol por defecto
        $stmt = $conn->prepare(
            "INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$nombre, $email, $hashed_password, 'usuario']);
        
        // Obtener el ID del usuario recién creado
        $user_id = $conn->lastInsertId();
        $user = [
            'id' => $user_id,
            'nombre' => $nombre,
            'email' => $email,
            'rol' => 'usuario'
        ];
    }

    // Crear sesión para el usuario
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nombre'];
    $_SESSION['user_rol'] = $user['rol'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['google_auth'] = true; // Marcar como autenticado con Google

    // Limpiar token CSRF
    unset($_SESSION['oauth_state']);

    // Redirigir a la página principal
    header("Location: /index.php");
    exit;

} catch (Exception $e) {
    // Limpiar token CSRF en caso de error
    unset($_SESSION['oauth_state']);
    
    $error_message = $e->getMessage();
    error_log("Error en Google Callback: " . $error_message);
    
    // Redirigir con el error
    $redirect_url = $login_page . "?error=" . urlencode($error_message);
    error_log("Redirigiendo a: " . $redirect_url);
    header("Location: " . $redirect_url);
    exit;
}
?>
