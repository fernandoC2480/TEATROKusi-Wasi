<?php
// base url de despliegue. ajustar si cambia el subdirectorio
$baseUrl = '/2025_II/grupo8/frontend/';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teatro Andino Kusiwasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Alegreya+Sans&display=swap" rel="stylesheet">

</head>
<body>

<header class="site-header">

  <!-- HEADER DESKTOP -->
  <div class="header-bg">
    <div class="header-inner">

      <a href="<?= $baseUrl ?>index.php" class="logo">
        <img src="<?= $baseUrl ?>assets/img/logo.png" alt="Logo Kusiwasi">
      </a>

      <nav class="nav">
        <ul class="nav-links">

          <li>
            <a href="<?= $baseUrl ?>index.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
              Inicio
            </a>
          </li>

          <li>
            <a href="<?= $baseUrl ?>pages/cartelera.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'cartelera.php' ? 'active' : '' ?>">
              Acciones Teatrales
            </a>
          </li>

          <li>
            <a href="<?= $baseUrl ?>pages/tienda.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'tienda.php' ? 'active' : '' ?>">
              Tienda
            </a>
          </li>

          <li class="has-submenu">
            <a href="<?= $baseUrl ?>pages/proyectos.php"
               class="<?= in_array(basename($_SERVER['PHP_SELF']), ['proyectos.php','tallerteatro.php','tallermusica.php']) ? 'active' : '' ?>">
              Proyectos
            </a>
            <ul class="submenu">
              <li><a href="<?= $baseUrl ?>pages/proyectos/tallerteatro.php">Taller de Teatro</a></li>
              <li><a href="<?= $baseUrl ?>pages/proyectos/tallermusica.php">Taller de Música</a></li>
            </ul>
          </li>

          <li class="has-submenu">
            <a href="<?= $baseUrl ?>pages/historia.php"
               class="<?= in_array(basename($_SERVER['PHP_SELF']), ['historia.php','misionvision.php']) ? 'active' : '' ?>">
              Nosotros
            </a>
            <ul class="submenu">
              <li><a href="<?= $baseUrl ?>pages/historia.php">Historia</a></li>
              <li><a href="<?= $baseUrl ?>pages/misionvision.php">Misión y Visión</a></li>
            </ul>
          </li>

          <li>
            <a href="<?= $baseUrl ?>pages/legal.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'legal.php' ? 'active' : '' ?>">
              Legal
            </a>
          </li>

          <li>
            <a href="<?= $baseUrl ?>pages/contacto.php"
               class="<?= basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : '' ?>">
              Contacto
            </a>
          </li>

          <!-- Icono Login Desktop -->
          <li>
            <a href="<?= $baseUrl ?>pages/login.php" class="login-circle">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
            </a>
          </li>

        </ul>
      </nav>

    </div>
  </div>

<!-- HEADER MÓVIL -->
<div class="mobile-header">

  <button class="menu-toggle" aria-label="Abrir menú">
    <i class="bi bi-list"></i>
  </button>

  <a href="<?= $baseUrl ?>index.php" class="mobile-logo">
    <img src="<?= $baseUrl ?>assets/img/logo.png" alt="Logo Kusiwasi">
  </a>

  <div class="mobile-title">
    <?= basename($_SERVER['PHP_SELF']) === 'index.php'
      ? 'Inicio'
      : ucfirst(str_replace('.php','',basename($_SERVER['PHP_SELF']))) ?>
  </div>

  <a href="<?= $baseUrl ?>pages/login.php" class="btn btn-outline-warning mobile-login-btn">
    <i class="bi bi-person"></i>
  </a>

</div>

<!-- MENÚ MÓVIL -->
<nav class="mobile-nav">
  <ul class="mobile-menu">

    <li><a href="<?= $baseUrl ?>index.php">Inicio</a></li>
    <li><a href="<?= $baseUrl ?>pages/cartelera.php">Acciones Teatrales</a></li>
    <li><a href="<?= $baseUrl ?>pages/tienda.php">Tienda</a></li>

    <li class="has-submenu">
      <a href="<?= $baseUrl ?>pages/proyectos.php" class="submenu-toggle">Proyectos</a>
      <ul class="submenu">
        <li><a href="<?= $baseUrl ?>pages/proyectos.php">Proyectos</a></li>
        <li><a href="<?= $baseUrl ?>pages/proyectos/tallerteatro.php">Taller de Teatro</a></li>
        <li><a href="<?= $baseUrl ?>pages/proyectos/tallermusica.php">Taller de Música</a></li>
      </ul>
    </li>

    <li class="has-submenu">
      <a href="<?= $baseUrl ?>pages/historia.php" class="submenu-toggle">Nosotros</a>
      <ul class="submenu">
        <li><a href="<?= $baseUrl ?>pages/historia.php">Nosotros</a></li>
        <li><a href="<?= $baseUrl ?>pages/historia.php">Historia</a></li>
        <li><a href="<?= $baseUrl ?>pages/misionvision.php">Misión y Visión</a></li>
      </ul>
    </li>

  </ul>
</nav>

</header>

<script src="<?= $baseUrl ?>assets/js/header.js"></script>
