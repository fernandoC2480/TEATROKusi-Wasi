<?php 
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

            <!-- RUTA CORREGIDA: sube dos niveles y entra a backend -->
            <form action="../../backend/src/auth/login_process.php" method="POST">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required placeholder="Tu contraseña">
                </div>

                <button type="submit" class="btn-submit">Entrar</button>
            </form>

            <p class="auth-footer">
                ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
            </p>
        </div>
    </div>
</body>
</html>
<?php include '../includes/footer.php'; ?>