<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
session_unset();
session_destroy();

// Redirigir al login
header("Location: ../../../frontend/pages/loging.php?success=" . urlencode("Sesión cerrada correctamente"));
exit;