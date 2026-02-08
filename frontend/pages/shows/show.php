<?php include '../../includes/header.php'; ?>
<link rel="stylesheet" href="../../assets/css/estilos_flecha.css">
<link rel="stylesheet" href="../../assets/css/shows.css">

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
        <h1 class="Titulo-Principal">Dioses Andinos</h1>
    <div class="sinopsis-container">
        <h2 class="sinopsis-title">Sinopsis</h2>
        <p class="sinopsis-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dictum, neque vitae ultrices suscipit, ex eros iaculis odio, vitae porttitor lectus turpis at orci. Aenean feugiat nunc vel lorem hendrerit, id vehicula justo aliquam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus malesuada purus in tortor tempor tincidunt.
            <br><br>
            Donec varius orci lacus, id placerat massa condimentum quis. In hac habitasse platea dictumst. Aliquam commodo libero id dui lobortis vestibulum. Nulla viverra blandit dictum. Integer id justo sed quam pharetra luctus vel non sapien.
        </p>
        <div class="d-flex justify-content-end">
            <a href="#" class="btn-reservar" data-bs-toggle="modal" data-bs-target="#modalReserva">Solicitar reserva</a>
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

<!-- MODAL DE RESERVA -->
<div class="modal fade" id="modalReserva" tabindex="-1" aria-labelledby="modalReservaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
<script src="../assets/js/scroll-arrow.js"></script>
<?php include '../../includes/footer.php'; ?>