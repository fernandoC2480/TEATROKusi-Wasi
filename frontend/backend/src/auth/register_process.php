<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

/**
 * 1. CARGA DE BASE DE DATOS
 * __DIR__ es .../backend/src/auth
 * Para llegar a config subimos un nivel: /../config/database.php
 */
require_once __DIR__ . '/../config/database.php';

/**
 * 2. RUTAS DE REDIRECCIÓN (Rutas Web)
 * Como tu servidor apunta a la raíz, usamos rutas que empiecen con /
 */
$url_register = "/frontend/pages/register.php";
$url_login    = "/frontend/pages/loging.php"; // Mantengo el nombre 'loging.php' según tu captura

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // Validaciones
    if (empty($nombre) || empty($email) || empty($password)) {
        header("Location: $url_register?error=" . urlencode("Campos obligatorios"));
        exit;
    }

    if ($password !== $confirm) {
        header("Location: $url_register?error=" . urlencode("Las contraseñas no coinciden"));
        exit;
    }

    try {
        $database = new Database();
        $conn = $database->getConnection();

        // Verificar si existe
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            header("Location: $url_register?error=" . urlencode("El email ya existe"));
            exit;
        }

        // Insertar
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, email, password, rol, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        $success = $stmt->execute([$nombre, $email, $hashed_password, 'moderador', 1]);

        if ($success) {
            header("Location: $url_login?success=" . urlencode("¡Registro exitoso! Inicia sesión"));
            exit;
        }

    } catch (Exception $e) {
        // En desarrollo puedes usar $e->getMessage(), en producción algo genérico
        header("Location: $url_register?error=" . urlencode("Error en el sistema"));
        exit;
    }
} else {
    header("Location: $url_register");
    exit;
}