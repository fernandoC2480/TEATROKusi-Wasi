<?php 
include '../includes/header.php';
include '../includes/image_helper.php';
include '../../backend/src/config/database.php';

// Conectar a la base de datos
$database = new Database();
$conn = $database->getConnection();

// Obtener productos de la base de datos
$query = "SELECT id, nombre, descripcion, precio, imagen, stock FROM productos WHERE estado = TRUE ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <?php
    // Cargar CSS específico para páginas (ej. tienda)
    $script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
    if (strpos($script, '/pages/tienda.php') !== false || basename($script) === 'tienda.php') {
        echo "<link rel=\"stylesheet\" href=\"../../assets/css/estios_tienda.css\">\n";
        echo "<link rel=\"stylesheet\" href=\"../../assets/css/estilos_flecha.css\">\n";
    }
    ?>
<main>
    <div class="imgtienda">
        <img src="../assets/img/imgcarrusel1.png" alt="">
    </div>
    <div class="titulo">
        <p>Recuerdos que mantienen viva la función</p>
    </div>

    <!-- Sección de Productos -->
    <div class="productos-container">
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <div class="producto-imagen">
                        <?php $imgPath = getProductImagePath($producto['imagen'], $producto['id'], $producto['nombre']); ?>
                        <img src="<?php echo htmlspecialchars($imgPath, ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    </div>
                    <div class="producto-info">
                        <div class="producto-nombre"><?php echo htmlspecialchars($producto['nombre']); ?></div>
                        <div class="producto-descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></div>
                        <div class="producto-footer">
                            <div>
                                <div class="producto-precio">S/. <?php echo number_format($producto['precio'], 2); ?></div>
                                <div class="producto-stock <?php echo $producto['stock'] <= 0 ? 'sin-stock' : ''; ?>">
                                    <?php echo $producto['stock'] > 0 ? 'Stock: ' . $producto['stock'] : 'Agotado'; ?>
                                </div>
                            </div>
                            <button class="btn-agregar" <?php echo $producto['stock'] <= 0 ? 'disabled' : ''; ?>>
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
</main>

<button class="scroll-arrow" id="scrollArrow" aria-label="Subir">↑</button>
<script src="../assets/js/scroll-arrow.js"></script>
<?php include '../includes/footer.php'; ?>
</body>
</html>