<?php 
// 1. Conexión y captura de ID
require_once "../../../backend/src/config/database.php";
$database = new Database();
$db = $database->getConnection();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header("Location: index.php"); // Redirigir si no hay ID
    exit;
}

// 2. Consultar datos del show
$query = "SELECT * FROM shows WHERE id = :id AND estado = 1 LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(":id", $id);
$stmt->execute();
$show = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$show) {
    echo "El show no existe o no está disponible.";
    exit;
}

include '../../includes/header.php'; 
?>
<link rel="stylesheet" href="../../assets/css/estilos_index.css">
<link rel="stylesheet" href="../../assets/css/estilos_flecha.css">

<!-- SECCIÓN DEL VIDEO -->
<section class="video-hero bg-transparent">
    <div class="container text-center py-4">
        <div class="video-wrapper shadow-lg">
            <div class="ratio ratio-16x9">
                <!-- Video dinámico desde YouTube ID -->
                <iframe src="https://www.youtube.com/embed/<?php echo $show['video_url']; ?>" 
                        title="YouTube video player" 
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

<main class="container my-5">
    <div class="seccion-subtitulos">
        <h1 class="t-show"><?php echo htmlspecialchars($show['nombre_show']); ?></h1>
    </div>
    
    <div class="sinopsis-container">
        <h2 class="sinopsis-title">Sinopsis</h2>
        <p class="sinopsis-text">
            <?php echo nl2br(htmlspecialchars($show['sinopsis'])); ?>
        </p>
        <div class="d-flex justify-content-end">
            <a href="#" class="btn-reservar" data-bs-toggle="modal" data-bs-target="#modalReserva">Solicitar reserva</a>
        </div>
    </div>

    <div class="container my-5 text-white">
        <div class="text-center mb-5">
            <h3 class="faq-show-title">Detalles del show</h3>
        </div>
        <div class="row text-center info-show-container">
            <!-- Duración dinámica -->
            <div class="col-md-4 info-show-item border-side">
                <i class="bi bi-clock"></i>
                <h4>Duración</h4>
                <p><?php echo htmlspecialchars($show['duracion']); ?></p>
            </div>
            <!-- Espacio Mínimo dinámico -->
            <div class="col-md-4 info-show-item border-side">
                <i class="bi bi-geo-alt"></i>
                <h4>Espacio Mínimo</h4>
                <p><?php echo htmlspecialchars($show['especificaciones']); ?></p>
            </div>
            <!-- Teléfono fijo o dinámico -->
            <div class="col-md-4 info-show-item">
                <i class="bi bi-telephone-fill"></i>
                <p class="phone-text">+51 915 844812</p>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h1 class="gallery-main-title">Galería</h1>
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <?php 
            $fotos = ['foto1', 'foto2', 'foto3'];
            foreach($fotos as $foto): 
                if(!empty($show[$foto])):
            ?>
            <div class="col">
                <div class="gallery-item">
                    <img src="../../assets/img/img_shows/<?php echo $show[$foto]; ?>" class="img-fluid gallery-img" alt="Imagen Show" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
            <?php 
                endif;
            endforeach; 
            ?>
        </div>
    </div>

    <!-- MODALES (Galería y Reserva) -->
    <!-- Modal Galería -->
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

    <!-- MODAL DE RESERVA -->
<div class="modal fade" id="modalReserva" tabindex="-1" aria-labelledby="modalReservaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="modalReservaLabel">Solicitud de Reserva</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formReserva">
                <div class="modal-body p-4">
                    <!-- Campo Show (Solo lectura, se llena automáticamente) -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Show seleccionado</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" id="reservaShow" name="show" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Número de teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <hr class="border-secondary">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipoCliente" class="form-label">Tipo de Solicitante</label>
                            <select class="form-select" id="tipoCliente" name="tipo_cliente">
                                <option value="persona">Persona Natural</option>
                                <option value="empresa">Empresa / Corporativo</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="docIdentidad" id="labelDoc" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="docIdentidad" name="documento" required>
                        </div>
                    </div>

                    <div class="mb-3" id="campoEmpresa" style="display: none;">
                        <label for="empresa" class="form-label">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa">
                    </div>

                    <hr class="border-secondary">

                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar de la presentación</label>
                        <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Ej: Hotel Hilton, Plaza de Armas..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-reservar">Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>

<script>
    // Lógica para la Galería
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('gallery-img')) {
            const src = e.target.getAttribute('src');
            document.getElementById('modalImage').src = src;
        }
    });

    // Lógica para el Formulario (Tipo de cliente)
    document.addEventListener('DOMContentLoaded', function() {
        const tipoCliente = document.getElementById('tipoCliente');
        const labelDoc = document.getElementById('labelDoc');
        const campoEmpresa = document.getElementById('campoEmpresa');

        if(tipoCliente) {
            tipoCliente.addEventListener('change', function() {
                if (this.value === 'empresa') {
                    labelDoc.innerText = 'RUC';
                    campoEmpresa.style.display = 'block';
                } else {
                    labelDoc.innerText = 'DNI';
                    campoEmpresa.style.display = 'none';
                }
            });
        }
    });
</script>

<button class="scroll-arrow" id="scrollArrow" aria-label="Subir">↑</button>
<script src="../../assets/js/scroll-arrow.js"></script>
<?php include '../../includes/footer.php'; ?>