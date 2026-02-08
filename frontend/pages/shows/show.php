<?php 
// 1. Conexión a la base de datos
require_once "../../backend/src/config/database.php";
$database = new Database();
$db = $database->getConnection();

// 2. Validar que se reciba un ID por la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para obtener los datos del show
    $query = "SELECT * FROM shows WHERE id = :id AND estado = 1 LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $show = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si el show no existe o está oculto, redirigir al catálogo
    if (!$show) {
        header("Location: ../../index.php"); // Cambia esto a tu página principal
        exit();
    }
} else {
    header("Location: ../../index.php");
    exit();
}

// 3. Preparar variables (Ruta de imágenes)
$path_img = "../../assets/img/img_shows/";

include '../../includes/header.php'; 
?>
<link rel="stylesheet" href="../../assets/css/estilos_flecha.css">
<link rel="stylesheet" href="../../assets/css/shows.css">

<!-- SECCIÓN DEL VIDEO -->
<section class="video-hero bg-transparent">
    <div class="container text-center py-4">
        <div class="video-wrapper shadow-lg">
            <div class="ratio ratio-16x9">
                <!-- Lógica para el ID de YouTube -->
                <iframe src="https://www.youtube.com/embed/<?php echo $show['video_url']; ?>" 
                        title="YouTube video player" 
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

<main class="container my-5">
    <div class="seccion-subtitulos">
        <h1><?php echo htmlspecialchars($show['nombre_show']); ?></h1>
    </div>
    <div class="sinopsis-container">
        <h2 class="sinopsis-title">Sinopsis</h2>
        <p class="sinopsis-text">
            <?php echo nl2br(htmlspecialchars($show['sinopsis'])); ?>
        </p>
        <div class="d-flex justify-content-end">
            <!-- Link a reserva pasando el ID del show -->
            <a href="../reserva.php?show_id=<?php echo $show['id']; ?>" class="btn-reservar">Solicitar reserva</a>
        </div>
    </div>
    <div class="container my-5 text-white">
        <!-- Título de la sección -->
        <div class="text-center mb-5">
            <h3 class="faq-show-title">Preguntas Frecuentes del show</h3>
        </div>
        <!-- Fila de 3 columnas -->
        <div class="row text-center info-show-container">
            <!-- Columna 1: Duración -->
            <div class="col-md-4 info-show-item border-side">
                <i class="bi bi-clock"></i>
                <h4>Duración</h4>
                <p><?php echo htmlspecialchars($show['duracion']); ?></p>
            </div>
            <!-- Columna 2: Ficha Técnica-->
            <div class="col-md-4 info-show-item border-side">
                <i class="bi bi-card-checklist"></i>
                <h4>Ficha Técnica</h4>
                <p><?php echo htmlspecialchars($show['especificaciones']); ?></p>
            </div>
            <!-- Columna 3: Teléfono -->
            <div class="col-md-4 info-show-item">
                <i class="bi bi-telephone-fill"></i>
                <p class="phone-text">+51 915 844812</p>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <h1 class="gallery-main-title">Galeria</h1>

        <div class="row row-cols-1 row-cols-md-3 g-3">
            <!-- Imagen 1 -->
            <?php if(!empty($show['foto1'])): ?>
            <div class="col">
                <div class="gallery-item">
                    <img src="<?php echo $path_img . $show['foto1']; ?>" class="img-fluid gallery-img" alt="Foto 1" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
            <?php endif; ?>

            <!-- Imagen 2 -->
            <?php if(!empty($show['foto2'])): ?>
            <div class="col">
                <div class="gallery-item">
                    <img src="<?php echo $path_img . $show['foto2']; ?>" class="img-fluid gallery-img" alt="Foto 2" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
            <?php endif; ?>

            <!-- Imagen 3 -->
            <?php if(!empty($show['foto3'])): ?>
            <div class="col">
                <div class="gallery-item">
                    <img src="<?php echo $path_img . $show['foto3']; ?>" class="img-fluid gallery-img" alt="Foto 3" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ESTRUCTURA DEL MODAL -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <img src="" id="modalImage" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('gallery-img')) {
            const src = e.target.getAttribute('src');
            document.getElementById('modalImage').src = src;
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
    const modalReserva = document.getElementById('modalReserva');
    const tipoCliente = document.getElementById('tipoCliente');
    const labelDoc = document.getElementById('labelDoc');
    const campoEmpresa = document.getElementById('campoEmpresa');
    const inputShow = document.getElementById('reservaShow');
    
    // 1. Al abrir el modal, capturar el nombre del Show desde la clase .reveal-title
    modalReserva.addEventListener('show.bs.modal', function () {
        const tituloShow = document.querySelector('.reveal-title').innerText;
        inputShow.value = tituloShow;
    });

    // 2. Lógica para cambiar entre DNI y RUC / Mostrar empresa
    tipoCliente.addEventListener('change', function() {
        if (this.value === 'empresa') {
            labelDoc.innerText = 'RUC';
            campoEmpresa.style.display = 'block';
            document.getElementById('empresa').setAttribute('required', 'true');
        } else {
            labelDoc.innerText = 'DNI';
            campoEmpresa.style.display = 'none';
            document.getElementById('empresa').removeAttribute('required');
        }
    });

    // 3. Manejo del envío (Opcional: aquí puedes añadir tu lógica de envío por AJAX/PHP)
    document.getElementById('formReserva').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Solicitud enviada para el show: ' + inputShow.value);
        // Aquí iría tu fetch() o envío a un archivo .php
    });
});
</script>
<button class="scroll-arrow" id="scrollArrow" aria-label="Subir">↑</button>
<script src="../../assets/js/scroll-arrow.js"></script>
<?php include '../../includes/footer.php'; ?>