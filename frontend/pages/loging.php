<?php 
require_once '../backend/src/config/google_config.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include '../includes/header.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Teatro Kusi-Wasi</title>
    <link rel="stylesheet" href="../assets/css/estilos_login.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Iniciar Sesión</h2>

            <?php
            // Mostrar errores o mensajes de éxito
            if (isset($_GET['error'])) {
                echo '<div style="color:red; margin-bottom:10px;">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            if (isset($_GET['success'])) {
                echo '<div style="color:green; margin-bottom:10px;">' . htmlspecialchars($_GET['success']) . '</div>';
            }
            ?>

            <!-- RUTA RELATIVA: desde pages a backend -->
            <form action="../backend/src/auth/login_process.php" method="POST">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required placeholder="Tu contraseña">
                </div>

                <button type="submit" class="btn-submit">Entrar</button>
                <div class="google">
                    <a href="../backend/src/auth/google_login.php">Iniciar sesión con Google <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                     <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                    </svg></a>
                </div>
            </form>

            <p class="auth-footer">
                ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
            </p>
        </div>
    </div>
</body>
</html>
<?php include '../includes/footer.php'; ?>