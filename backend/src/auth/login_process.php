<?php
// backend/src/auth/login_process.php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

require_once __DIR__ . '/../config/database.php';

// Ruta para volver a las páginas si algo sale mal
$pags = "../../../frontend/pages/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: " . $pags . "loging.php?error=" . urlencode("Por favor, llena todos los campos"));
        exit;
    }

    try {
        $database = new Database();
        $conn = $database->getConnection();

        // Buscamos al usuario por email
        // IMPORTANTE: Asegúrate de que la columna en tu BD sea 'contraseña' con ñ
        $stmt = $conn->prepare("SELECT id, nombre, email, contraseña, rol FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificamos si existe el usuario y si la contraseña es correcta
        if ($user && password_verify($password, $user['contraseña'])) {
            
            // Login exitoso: Creamos las variables de sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_rol'] = $user['rol'];

            // Redirigir al panel principal o al index
            // Sube 3 niveles para llegar a la raíz donde está el index.php
            header("Location: ../../../index.php"); 
            exit;

        } else {
            // Error de credenciales
            header("Location: " . $pags . "loging.php?error=" . urlencode("Email o contraseña incorrectos"));
            exit;
        }

    } catch (PDOException $e) {
        header("Location: " . $pags . "loging.php?error=" . urlencode("Error de base de datos"));
        exit;
    }

} else {
    header("Location: " . $pags . "loging.php");
    exit;
}