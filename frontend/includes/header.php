<?php
/**
 * Header unificado - Teatro Kusiwasi
 * Fusión de header.php y he.php con correcciones
 */

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// Detectar si estamos en la tienda
$script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
$es_tienda = (strpos($script, '/pages/tienda.php') !== false || basename($script) === 'tienda.php');

// Detectar página actual para links activos
$current_page = basename($_SERVER['PHP_SELF']);
$page_title = ucfirst(str_replace('.php', '', $current_page));

// Helper para clase activa
function isActive($page) {
    $current = basename($_SERVER['PHP_SELF']);
    if ($page === 'inicio' && $current === 'index.php') return 'active';
    if ($current === $page . '.php') return 'active';
    if ($page === 'proyectos' && in_array($current, ['proyectos.php', 'tallerteatro.php', 'tallermusica.php'])) return 'active';
    if ($page === 'nosotros' && in_array($current, ['historia.php', 'misionvision.php'])) return 'active';
    return '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teatro Andino Kusiwasi</title>
    
    <!-- Fuentes Google (cargadas una sola vez) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Cinzel+Decorative:wght@400;700;900&family=Alegreya:wght@600;700&family=Alegreya+Sans&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Estilos locales -->
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/estilos_flecha.css">
</head>
<body>

<header class="site-header">

    <!-- HEADER DESKTOP -->
    <div class="header-bg">
        <div class="header-inner">

            <!-- Logo -->
            <a href="../../index.php" class="logo">
                <img src="../../assets/img/logo.png" alt="Logo Kusiwasi">
            </a>

            <!-- Navegación Desktop -->
            <nav class="nav">
                <ul class="nav-links">

                    <li>
                        <a href="../../index.php" class="<?= isActive('index') ?>">
                            Inicio
                        </a>
                    </li>

                    <li>
                        <a href="../../pages/cartelera.php" class="<?= isActive('cartelera') ?>">
                            Acciones Teatrales
                        </a>
                    </li>

                    <li>
                        <a href="../../pages/tienda.php" class="<?= isActive('tienda') ?>">
                            Tienda
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="../../pages/proyectos.php" class="<?= isActive('proyectos') ?>">
                            Proyectos
                        </a>
                        <ul class="submenu">
                            <li><a href="../../pages/proyectos/tallerteatro.php">Taller de Teatro</a></li>
                            <li><a href="../../pages/proyectos/tallermusica.php">Taller de Música</a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="../../pages/historia.php" class="<?= isActive('nosotros') ?>">
                            Nosotros
                        </a>
                        <ul class="submenu">
                            <li><a href="../../pages/historia.php">Historia</a></li>
                            <li><a href="../../pages/misionvision.php">Misión y Visión</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="../../pages/legal.php" class="<?= isActive('legal') ?>">
                            Legal
                        </a>
                    </li>

                    <li>
                        <a href="../../pages/contacto.php" class="<?= isActive('contacto') ?>">
                            Contacto
                        </a>
                    </li>

                    <!-- Carrito (solo en tienda) -->
                    <?php if ($es_tienda): ?>
                    <li class="cart-icon">
                        <a href="#" title="Carrito">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Usuario / Autenticación -->
                    <li class="auth-item">
                        <?php if (isset($_SESSION['user_name'])): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-check-fill"></i>
                                <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../../backend/src/auth/logout.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                        <?php else: ?>
                        <a href="../../pages/loging.php" class="login-circle" title="Inicia sesión">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </a>
                        <?php endif; ?>
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

        <a href="../../index.php" class="mobile-logo">
            <img src="../../assets/img/logo.png" alt="Logo Kusiwasi">
        </a>

        <div class="mobile-title">
            <?= ($current_page === 'index.php') ? 'Inicio' : $page_title ?>
        </div>

        <?php if (!isset($_SESSION['user_name'])): ?>
        <a href="../../pages/loging.php" class="btn btn-outline-warning mobile-login-btn">
            <i class="bi bi-person"></i>
        </a>
        <?php endif; ?>
    </div>

    <!-- MENÚ MÓVIL -->
    <nav class="mobile-nav">
        <ul class="mobile-menu">
            <li><a href="../../index.php">Inicio</a></li>
            <li><a href="../../pages/cartelera.php">Acciones Teatrales</a></li>
            <li><a href="../../pages/tienda.php">Tienda</a></li>

            <li class="has-submenu">
                <a href="../../pages/proyectos.php" class="submenu-toggle">Proyectos</a>
                <ul class="submenu">
                    <li><a href="../../pages/proyectos/tallerteatro.php">Taller de Teatro</a></li>
                    <li><a href="../../pages/proyectos/tallermusica.php">Taller de Música</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="../../pages/historia.php" class="submenu-toggle">Nosotros</a>
                <ul class="submenu">
                    <li><a href="../../pages/historia.php">Historia</a></li>
                    <li><a href="../../pages/misionvision.php">Misión y Visión</a></li>
                </ul>
            </li>

            <li><a href="../../pages/legal.php">Legal</a></li>
            <li><a href="../../pages/contacto.php">Contacto</a></li>

            <?php if (isset($_SESSION['user_name'])): ?>
            <li><a href="#">Mi Perfil</a></li>
            <li><a href="../../backend/src/auth/logout.php">Cerrar Sesión</a></li>
            <?php else: ?>
            <li><a href="../../pages/loging.php">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>

</header>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script del header -->
<script src="../../assets/js/header.js"></script>

</body>
</html>