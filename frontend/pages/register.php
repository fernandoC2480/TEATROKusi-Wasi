<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include '../includes/header.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Teatro Kusi-Wasi</title>
    <link rel="stylesheet" href="../assets/css/estilos_login.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Crear Cuenta</h2>

            <?php
            if (isset($_GET['error'])) {
                echo '<div style="color:red; background:#fee; padding:10px; margin-bottom:10px; border-radius:5px;">✗ ' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>

            <!-- RUTA CLAVE: Sube dos niveles para salir de frontend/pages y entrar a backend -->
            <form action="../../backend/src/auth/register_process.php" method="POST">
                <div class="form-group">
                    <label>Nombre Completo:</label>
                    <input type="text" name="nombre" required placeholder="Tu nombre">
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required placeholder="correo@ejemplo.com">
                </div>

                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required placeholder="Mínimo 6 caracteres">
                </div>

                <div class="form-group">
                    <label>Confirmar Contraseña:</label>
                    <input type="password" name="confirm_password" required placeholder="Repite tu contraseña">
                </div>

                <button type="submit" class="btn-submit">Registrarse</button>
            </form>

            <p class="auth-footer">
                ¿Ya tienes cuenta? <a href="loging.php">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</body>
</html>
<?php include '../includes/footer.php'; ?>