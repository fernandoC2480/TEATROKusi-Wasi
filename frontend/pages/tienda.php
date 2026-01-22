<?php 
include '../includes/header.php';
include '../includes/image_helper.php';
include '../../backend/src/config/database.php';

// Conectar a la base de datos
$database = new Database();
$conn = $database->getConnection();

// Configuración de paginación
$productos_por_pagina = 21;
$pagina_actual = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Obtener total de productos
$query_total = "SELECT COUNT(*) as total FROM productos WHERE estado = TRUE";
$stmt_total = $conn->prepare($query_total);
$stmt_total->execute();
$total_productos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
$total_paginas = ceil($total_productos / $productos_por_pagina);

// Asegurar que la página no sea mayor que el total
$pagina_actual = min($pagina_actual, max(1, $total_paginas));

// Calcular offset
$offset = ($pagina_actual - 1) * $productos_por_pagina;

// Obtener productos de la base de datos con paginación
$query = "
    SELECT 
        p.id,
        p.nombre,
        p.descripcion,
        p.precio,
        p.imagen,
        p.stock,
        c.nombre AS categoria_nombre
    FROM productos p
    INNER JOIN categorias_tienda c ON p.categoria_id = c.id
    WHERE p.estado = TRUE
    ORDER BY p.id DESC
    LIMIT :limit OFFSET :offset
";
$stmt = $conn->prepare($query);
$stmt->bindValue(':limit', $productos_por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/cards.css">
<link rel="stylesheet" href="../assets/css/estilos_flecha.css">
<link rel="stylesheet" href="../../assets/css/acordeon-tienda-categoria.css">
 
<main>
    <!-- acordeon de categorias -->
    <div class="options">
        <div class="option ropa active">
            <div class="shadow"></div>
            <div class="label">
            <div class="icone"><i class="fas fa-shirt"></i></div>
            <div class="info">
                <div class="main">Ropa</div>
                <div class="sub">Tradición viva</div>
            </div>
            <a href="#" class="btn-categoria">Ver categoría</a>
            </div>
        </div>

        <div class="option accesorios">
            <div class="shadow"></div>
            <div class="label">
            <div class="icone"><i class="fas fa-gem"></i></div>
            <div class="info">
                <div class="main">Accesorios</div>
                <div class="sub">Cosmovisión andina</div>
            </div>
            <a href="#" class="btn-categoria">Ver categoría</a>
            </div>
        </div>

        <div class="option libros">
            <div class="shadow"></div>
            <div class="label">
            <div class="icone"><i class="fas fa-book-open"></i></div>
            <div class="info">
                <div class="main">Libros</div>
                <div class="sub">Sabiduría ancestral</div>
            </div>
            <a href="#" class="btn-categoria">Ver categoría</a>
            </div>
        </div>

        <div class="option recuerdos">
            <div class="shadow"></div>
            <div class="label">
            <div class="icone"><i class="fas fa-sun"></i></div>
            <div class="info">
                <div class="main">Recuerdos</div>
                <div class="sub">Espíritu andino</div>
            </div>
            <a href="#" class="btn-categoria">Ver categoría</a>
            </div>
        </div>

    </div>
     <!-- fin de acordeon de categorias -->
    <div class="seccion-titulos text-center">
        <h1>Recuerdos que mantienen viva la función</h1>
    </div>

    <!-- Sección de Productos -->
     <!-- Sección de Productos -->
    <section class="tienda">
    <div class="container">

        <?php if ($productos): ?>
        <?php foreach ($productos as $producto): ?>

            <?php
            // clase CSS según categoría
            $clase_categoria = 'cat-' . strtolower($producto['categoria_nombre']);

            // imagen
            $imgPath = getProductImagePath(
                $producto['imagen'],
                $producto['id'],
                $producto['nombre']
            );
            ?>

        <a href="producto.php?id=<?= $producto['id']; ?>" class="card">

            <div class="card-inner">
                <div class="box">

                <div class="imgBox">
                    <img
                    src="<?= htmlspecialchars($imgPath); ?>"
                    alt="<?= htmlspecialchars($producto['nombre']); ?>">
                </div>

                <!-- BOTÓN CARRITO (solo visual por ahora) -->
                <div class="icon">
                <button class="iconBox btn-add-cart" 
                        data-product-id="<?= $producto['id']; ?>" 
                        aria-label="Agregar <?= htmlspecialchars($producto['nombre']); ?> al carrito">
                    <!-- Icono SVG seguro -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dfaf0f" viewBox="0 0 24 24">
                        <path d="M7 4h-2l-1 2h2l3 8h8l3-8h2l-1-2h-2l-1 2h-8l-1-2zm2 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm8 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </button>
            </div>

            </div>
            </div>

            <!-- CONTENIDO -->
            <div class="content">
                <h3><?= htmlspecialchars($producto['nombre']); ?></h3>

                <ul class="categorias">
                    <li class="<?= $clase_categoria; ?>">
                        <?= htmlspecialchars($producto['categoria_nombre']); ?>
                    </li>
                </ul>

                <p><?= htmlspecialchars($producto['descripcion']); ?></p>

                <!-- PRECIO -->
                <p class="precio">S/. <?= number_format($producto['precio'], 2); ?></p>
            </div>
        </a>

        <?php endforeach; ?>
        <?php else: ?>
        <p>No hay productos disponibles.</p>
        <?php endif; ?>

    </div>
    </section>


    <!-- Sección de Paginación -->
    <?php if ($total_paginas > 1): ?>
    <div class="paginacion">
        <!-- Flecha anterior -->
        <?php if ($pagina_actual > 1): ?>
            <a href="?page=<?php echo $pagina_actual - 1; ?>" class="paginacion-flecha" title="Página anterior">←</a>
        <?php else: ?>
            <span class="paginacion-flecha deshabilitada">←</span>
        <?php endif; ?>

        <!-- Números de página -->
        <div class="paginacion-numeros">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <?php if ($i == $pagina_actual): ?>
                    <span class="paginacion-numero activo"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>" class="paginacion-numero"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <!-- Flecha siguiente -->
        <?php if ($pagina_actual < $total_paginas): ?>
            <a href="?page=<?php echo $pagina_actual + 1; ?>" class="paginacion-flecha" title="Página siguiente">→</a>
        <?php else: ?>
            <span class="paginacion-flecha deshabilitada">→</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</main>

<button class="scroll-arrow" id="scrollArrow" aria-label="Subir">↑</button>
<script src="../assets/js/scroll-arrow.js"></script>
<script src="../../assets/js/acordeon_tienda.js"></script>
<?php include '../includes/footer.php'; ?>