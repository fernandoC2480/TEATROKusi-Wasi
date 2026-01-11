<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/proyecto.css">
<link rel="stylesheet" href="../assets/css/caruselproy.css">
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
<link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">


<body>
    <!--inicio de imagen con titulo-->
    <div class="contenedor_proyectos">
        <div class="degradado1">
        <img src="../assets/img/img_proyectos/proyectos.jpg" alt="p1" class="p1">
        </div>
        <h1 class="titulo1">PROXIMAS <br> EXPERERIENCIAS UNICAS<br> QUE NO TE PUEDES <br>PERDER</h1>
    </div>
    <!--fin -->
    <!--inicio de  card los proyectos-->
    <div class="linea-icono-linea">
      <div class="linea"></div>
        <div class="icono">
        <img src="../assets/img/img_proyectos/adorno1.png" alt="icono" />
         </div>
      <div class="linea"></div>
    </div>
    <div class="contenedor-cards">

    <!-- Card 1: Imagen izquierda, texto derecha -->
    <div class="card1">
        <h2 class="cardt1">Obras</h2>
        <div class="cardcont1">
            <img src="../assets/img/img_proyectos/card2.jpg" alt="imgcard1" class="cardimg1">
            <div class="cardtxt1">
                <p>
                    Promover, preservar y difundir la cultura ancestral andina a través del arte escénico, formando integralmente a niños, jóvenes y adultos en teatro, música y danza, y generando oportunidades laborales dignas para los artistas, contribuyendo al desarrollo cultural, social y humano de la comunidad.
                </p>
                <button class="cardboton1">Saber más</button>
            </div>
        </div>
    
    </div>
    <!-- adorno 2 -->
    <div class="linea-icono-linea">
      <div class="linea"></div>
        <div class="icono2">
        <img src="../assets/img/img_proyectos/adorno2.png" alt="icono" />
         </div>
      <div class="linea"></div>
    </div>

    <!-- Card 2: Imagen derecha, texto izquierda -->
    <div class="card2">
        <h2 class="cardt2">Obras Internacionales</h2>
        <div class="cardcont2">
            <img src="../assets/img/img_proyectos/card1.jpg" alt="imgcard2" class="cardimg2">
            <div class="cardtxt2">
                <p>
                    Ser una organización artística referente a nivel nacional e internacional en la creación y difusión del teatro andino, reconocida por su calidad artística, su compromiso con la identidad cultural y su aporte a la formación de artistas y públicos conscientes de su herencia cultural y valores socio-comunitarios.
                </p>
                <button class="cardboton2">Saber más</button>
            </div>
        </div>
    </div>
    <!-- adorno 3 -->
    <div class="linea-icono-linea">
      <div class="linea"></div>
        <div class="icono3">
        <img src="../assets/img/img_proyectos/adorno3.png" alt="icono" />
         </div>
      <div class="linea"></div>
    </div>
    </div>
    <h1 class="titulo2">MAS PROYECTOS</h1>
    <!-- Carrusel -->
    <section class="carousel-3d">
  <div class="swiper">

    <div class="swiper-wrapper">

      <!-- ===== CARD 1 ===== -->
      <div class="swiper-slide">
        <article class="card">

          <img 
            src="../assets/img/img_proyectos/carrusel1.jpg"
            alt="Obra teatral 1"
            class="card__img"
          >

          <div class="card__content">
            <h2 class="card__title">Obras</h2>
            <h4 class="card__subtitle">Teatro Andino</h4>

            <p class="card__text">
              Promover, preservar y difundir la cultura ancestral andina a
              través del arte escénico, formando integralmente a niños,
              jóvenes y adultos.
            </p>

            <button class="btn-primary">Saber más</button>
          </div>

        </article>
      </div>

      <!-- ===== CARD 2 ===== -->
      <div class="swiper-slide">
        <article class="card">

          <img 
            src="../assets/img/img_proyectos/carrusel2.jpg"
            alt="Obra teatral 2"
            class="card__img"
          >

          <div class="card__content">
            <h2 class="card__title">Formación</h2>
            <h4 class="card__subtitle">Arte y Comunidad</h4>

            <p class="card__text">
              Formación artística integral en teatro, música y danza,
              fortaleciendo la identidad cultural y el desarrollo humano.
            </p>

            <button class="btn-primary">Saber más</button>
          </div>

        </article>
      </div>

      <!-- ===== CARD 3 ===== -->
      <div class="swiper-slide">
        <article class="card">

          <img 
            src="../assets/img/img_proyectos/carrusel3.jpg"
            alt="Obra teatral 3"
            class="card__img"
          >

          <div class="card__content">
            <h2 class="card__title">Experiencias</h2>
            <h4 class="card__subtitle">Escena Viva</h4>

            <p class="card__text">
              Experiencias escénicas únicas que conectan al público con
              la memoria, la emoción y el arte andino contemporáneo.
            </p>

            <button class="btn-primary">Saber más</button>
          </div>

        </article>
      </div>

    </div>

    <!-- Scrollbar -->
    <div class="swiper-scrollbar"></div>

  </div>
    </section>


</body>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="../assets/js/caruselproy.js"></script>
<?php include '../includes/footer.php'; ?>