<?php include '../../includes/header.php'; ?>
<link rel="stylesheet" href="../../assets/css/estilos_flecha.css">

<!-- SECCIÓN DEL VIDEO -->
<section class="video-hero bg-transparent">
    <div class="container text-center py-4">
        <div class="video-wrapper shadow-lg">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/8VB0_5ehQSg?si=PIwLXfJROHH3t5d4" 
                        title="YouTube video player" 
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

<main class="container my-5">
    <div class="seccion-subtitulos">
        <h1>Dioses Andinos</h1>
    </div>
    <div class="sinopsis-container">
        <h2 class="sinopsis-title">Sinopsis</h2>
        <p class="sinopsis-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dictum, neque vitae ultrices suscipit, ex eros iaculis odio, vitae porttitor lectus turpis at orci. Aenean feugiat nunc vel lorem hendrerit, id vehicula justo aliquam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus malesuada purus in tortor tempor tincidunt.
            <br><br>
            Donec varius orci lacus, id placerat massa condimentum quis. In hac habitasse platea dictumst. Aliquam commodo libero id dui lobortis vestibulum. Nulla viverra blandit dictum. Integer id justo sed quam pharetra luctus vel non sapien.
        </p>
        <div class="d-flex justify-content-end">
            <a href="#" class="btn-reservar">Solicitar reserva</a>
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
                <p>25 min</p>
            </div>
            <!-- Columna 2: Ficha Técnica-->
            <div class="col-md-4 info-show-item border-side">
                <i class="bi bi-card-checklist"></i>
                <h4>Ficha Técnica</h4>
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
            <div class="col">
                <div class="gallery-item">
                    <img src="../../assets/img/imagencartelera1.png" class="img-fluid gallery-img" alt="Imagen 1" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
            <!-- Imagen 2 -->
            <div class="col">
                <div class="gallery-item">
                    <img src="../assets/img/galeria2.png" class="img-fluid gallery-img" alt="Imagen 2" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
            <!-- Imagen 3 -->
            <div class="col">
                <div class="gallery-item">
                    <img src="../assets/img/galeria3.png" class="img-fluid gallery-img" alt="Imagen 3" data-bs-toggle="modal" data-bs-target="#galleryModal">
                </div>
            </div>
        </div>
    </div>

    <!-- ESTRUCTURA DEL MODAL (Pon esto al final de tu archivo, antes del footer) -->
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
</script>
<button class="scroll-arrow" id="scrollArrow" aria-label="Subir">↑</button>
<script src="../assets/js/scroll-arrow.js"></script>
<?php include '../../includes/footer.php'; ?>