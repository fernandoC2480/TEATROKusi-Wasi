<?php
session_start();
session_unset();
session_destroy();

// Redirigir al inicio después de cerrar sesión
header("Location: ../../../index.php");
exit;