<?php
// backend/src/auth/register_process.php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Cargar la base de datos de forma segura
require_once __DIR__ . '/../config/database.php';

// Variable para volver a la carpeta de páginas fácilmente
// Sube 3 niveles: de /auth/ a /src/ a /backend/ a la RAÍZ, luego entra a frontend
$path_frontend = "../../../frontend/pages/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // 1. Validaciones de seguridad
    if (empty($nombre) || empty($email) || empty($password)) {
        header("Location: " . $path_frontend . "register.php?error=" . urlencode("Todos los campos son obligatorios"));
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . $path_frontend . "register.php?error=" . urlencode("El email no es válido"));
        exit;
    }

    if (strlen($password) < 6) {
        header("Location: " . $path_frontend . "register.php?error=" . urlencode("La contraseña debe tener al menos 6 caracteres"));
        exit;
    }

    if ($password !== $confirm_password) {
        header("Location: " . $path_frontend . "register.php?error=" . urlencode("Las contraseñas no coinciden"));
        exit;
    }

    try {
        $database = new Database();
        $conn = $database->getConnection();

        if ($conn === null) {
            throw new Exception("No se pudo conectar a la base de datos.");
        }

        // 2. Verificar si el email ya existe para evitar duplicados
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            header("Location: " . $path_frontend . "register.php?error=" . urlencode("Este email ya está registrado"));
            exit;
        }

        // 3. Encriptar contraseña y Guardar
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // IMPORTANTE: Verifica que tus columnas se llamen así (nombre, email, contraseña, rol, estado)
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Ejecutamos (rol: moderador por defecto, estado: 1 activo)
        $success = $stmt->execute([$nombre, $email, $hashed_password, 'moderador', 1]);

        if ($success) {
            // Registro exitoso -> Mandar al Login (con 'g')
            header("Location: " . $path_frontend . "loging.php?success=" . urlencode("Cuenta creada. ¡Ya puedes iniciar sesión!"));
            exit;
        } else {
            throw new Exception("Error al guardar los datos.");
        }

    } catch (Exception $e) {
        header("Location: " . $path_frontend . "register.php?error=" . urlencode($e->getMessage()));
        exit;
    }

} else {
    header("Location: " . $path_frontend . "register.php");
    exit;
}