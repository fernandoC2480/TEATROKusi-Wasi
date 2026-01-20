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
$query = "SELECT id, nombre, descripcion, precio, imagen, stock FROM productos WHERE estado = TRUE ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindValue(':limit', $productos_por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <?php
    // Cargar CSS específico para páginas (ej. tienda)
    $script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
    if (strpos($script, '/pages/tienda.php') !== false || basename($script) === 'tienda.php') {
        echo "<link rel=\"stylesheet\" href=\"../../assets/css/tienda-escenica.css\">\n";
        echo "<link rel=\"stylesheet\" href=\"../../assets/css/estilos_flecha.css\">\n";
    }
    ?>
<main>
    <div class="imgtienda">
        <img src="../assets/img/imgcarrusel1.png" alt="">
    </div>
    <div class="seccion-titulos text-center">
        <h1>Recuerdos que mantienen viva la función</h1>
    </div>

    <!-- Sección de Productos -->
    <div class="productos-container">
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                    <div class="tienda-card">

                        <!-- Halo -->
                        <div class="tienda-halo"></div>

                        <!-- Imagen (tu lógica se mantiene) -->
                        <div class="tienda-img">
                        <?php
                            $imgPath = getProductImagePath(
                            $producto['imagen'],
                            $producto['id'],
                            $producto['nombre']
                            );
                        ?>
                        <img
                            src="<?= htmlspecialchars($imgPath, ENT_QUOTES); ?>"
                            alt="<?= htmlspecialchars($producto['nombre']); ?>">
                        </div>

                        <!-- Contenido -->
                        <div class="tienda-content">

                        <h3 class="tienda-title">
                            <?= htmlspecialchars($producto['nombre']); ?>
                        </h3>

                        <p class="tienda-desc">
                            <?= htmlspecialchars($producto['descripcion']); ?>
                        </p>

                        <div class="tienda-stock <?= $producto['stock'] > 0 ? 'ok' : 'out'; ?>">
                            <?= $producto['stock'] > 0 ? 'Stock: '.$producto['stock'] : 'Agotado'; ?>
                        </div>

                        <div class="tienda-accion">
                            <div class="tienda-precio">
                                S/. <?= number_format($producto['precio'], 2); ?>
                            </div>

                            <button
                                class="tienda-btn"
                                <?= $producto['stock'] <= 0 ? 'disabled' : ''; ?>>
                                Agregar
                            </button>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="sin-productos">
                <p>No hay productos disponibles en este momento.</p>
            </div>
        <?php endif; ?>
    </div>

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
<?php include '../includes/footer.php'; ?>