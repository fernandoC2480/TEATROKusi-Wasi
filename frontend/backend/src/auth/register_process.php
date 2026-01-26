<?php
// backend/src/auth/register_process.php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

require_once __DIR__ . '/../config/database.php';

// EXPLICACIÓN DE LA RUTA:
// 1. ..  (sale de 'auth' a 'src')
// 2. ..  (sale de 'src' a 'backend')
// 3. ..  (sale de 'backend' a 'frontend')
// Luego entra a 'pages/'
$path_to_pages = "../../../pages/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($password)) {
        header("Location: " . $path_to_pages . "register.php?error=" . urlencode("Todos los campos son obligatorios"));
        exit;
    }

    try {
        $database = new Database();
        $conn = $database->getConnection();

        // Verificar si el email ya existe
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            header("Location: " . $path_to_pages . "register.php?error=" . urlencode("Este email ya está registrado"));
            exit;
        }

        // Encriptar y Guardar
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Registro exitoso
        $success = $stmt->execute([$nombre, $email, $hashed_password, 'moderador', 1]);

        if ($success) {
            // REDIRECCIÓN AL LOGIN
            // Usamos 'loging.php' porque así se llama tu archivo según la imagen
            header("Location: " . $path_to_pages . "loging.php?success=" . urlencode("Registro exitoso. ¡Inicia sesión!"));
            exit;
        }

    } catch (Exception $e) {
        header("Location: " . $path_to_pages . "register.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}