<?php
include 'includes/header.php';
?>
<!--link de estilos CSS para el carrusel y el cuerpo de la página -->
<link rel="stylesheet" href="assets/css/carruselindex.css">
<link rel="stylesheet" href="assets/css/cuerpo_index.css">
<link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/estilos_flecha.css">
<!--inicio de carrusel NO TOCAR porque funciona con fe-->
<body>
<div class="contenedor">
    <div class="slide">
        <div class="item" style="background-image: url(../assets/img/carrusel2.jpeg);">
            <div class="content">
                <div class="name">Kusi Wasi</Wbr></div>
                <div class="des">Somos un grupo donde interpretamos relatos andinos que se sientan con el corazon nuetras obras y musica andina</div>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel5.jpg);">
            <div class="content">
                <div class="name">Acciones Teatrales</Wbr></div>
                <div class="des">Un ecenario donde los relatos andinos se vuelven un momento inolvidable</div>
                <a  href="../pages/cartelera.php" style="text-decoration: none;">
                <button>Visitar</button>
                </a>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel3.jpg);">
            <div class="content">
                <div class="name">Tienda</div>
                <div class="des">Visite la tienda.. "Un recuerdo, unn estilo, una forma de ver el estilo andino para llevar a donde quiera"</div>
                <a  href="../pages/tienda.php" style="text-decoration: none;">
                <button>Visitar Tienda</button>
                </a>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel4.jpg);">
            <div class="content">
                <div class="name">Proyetos</div>
                <div class="des">Encuentra lo que ofrecemos y lo que se vendra muy pronto</div>
                <a  href="../pages/proyectos.php" style="text-decoration: none;">
                <button>Visitar</button>
                </a>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carruselgif.gif);">
            <div class="content">
                <div class="name">Netherland</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel30.jpg);">
            <div class="content">
                <div class="name">Musica y mas</div>
                <div class="des">Puedes ser parte de nosotros en muscica danza y mucho mas...</div>
                <a  href="../../pages/proyectos/tallermusica.php" style="text-decoration: none;">
                <button>Visitar musical</button>
                </a>
            </div>
        </div>
    </div>

    <div class="button">
        <button class="prev"><img src="assets/img/izquierda.png" alt="Anterior"></button>
        <button class="next"><img src="assets/img/derecha.png" alt="Siguiente"></button>
    </div>
</div>
<!--FIN DE CARRUSEL-->
<!--INICIO DEL titulo  1-->
<div class="titulo1">
        <img src="../assets/img/decoracion_index.png" alt="Flor decorativa" class="flor">
        <h1 class="texto-titulo">Nuestras Actuaciones</h1>
</div>
<!--cartas-->
<div class="actuaciones">
    <div class="actuacion">
        <img src="../assets/img/carta1.jpg" alt="Actuación 1">
        <div class="info">
            <h3>GUARDIAN DE EL PUEBLO</h3>
            <p class="texto-corto">Tradicion de un prueblo</p>
            <p class="texto-largo">Aquí va una descripción más extensa...</p>
            <a href="../pages/cartelera.php#eclesiasticos" class="t2">Saber más</a>
        </div>
    </div>

    <div class="actuacion">
        <img src="../assets/img/carta2.jpg" alt="Actuación 2">
        <div class="info">
            <h3>LA BELLEZA DEL AGUA</h3>
            <p class="texto-corto">Peces y ríos.. nadie sabe quien los cuida.</p>
            <p class="texto-largo">Información adicional de la actuación...</p>
            <a href="../pages/cartelera.php#ancestrales" class="t2">Saber más</a>
        </div>
    </div>

    <div class="actuacion">
        <img src="../assets/img/cart3.jpg" alt="Actuación 3">
        <div class="info">
            <h3>LA MADRE NATURALESA</h3>
            <p class="texto-corto">MADRE DE TODA FLORA Y FAUNA</p>
            <p class="texto-largo">Descripción ampliada de la experiencia cultural...</p>
            <a href="../pages/cartelera.php#ecologicos" class="t2">Saber más</a>
        </div>
    </div>     
</div>
<!--titulo 2-->
<div class="titulo2">
        <img src="../assets/img/decoracion_nosotros.png" alt="patrones" class="patron">
        <img src="../assets/img/decoracion_nosotros.png" alt="patrones" class="patron1">
        <h1 class="texto-titulo2">Nosotros</h1>
</div> 
 <!--parte nosotros card-->
    <div class="card-wrapper">
  <div class="cardN reveal-img">

    <img src="../assets/img/img_nosotros.png" class="card-imgN img-reveal">

    <div class="card-overlayN">
      <div class="reveal-text">
        <img src="../assets/img/nosotros_icon.png" class="iconN">

        <h3 class="card-titleN">Nuestra Historia</h3>

        <p class="card-textN">
         uiiia.
        </p>
        <a href="../pages/historia.php">
        <button class="card-btnN">Saber más</button>
        </a>
      </div>
    </div>

  </div>
    </div>
    <!--parte proyectos-->
<div class="proyectosM">
  <h1 class="titulo_proyecto">Nuevos Proyectos</h1>

  <!-- CARD 1 -->
  <div class="proy1 reveal-card left">
    <img src="../assets/img/img_proyectos/card1f.jpg" class="img-anim">

    <div class="inf1 text-anim">
      <h3 class="t1">Lo nuevo</h3>

      <p class="largo">
        Aquí va una descripción más extensa con detalles,
        fechas, artistas y contexto cultural del evento.
      </p>
      <a href="../pages/proyectos.php#nuevo">
         <button class="t2">Saber más</button>
      </a>
    </div>
  </div>

  <!-- CARD 2 -->
  <div class="proy2 reveal-card right">
    <img src="../assets/img/carta2.jpg" class="img-anim">

    <div class="inf2 text-anim">
      <h3 class="t1">Arte y muscho mas</h3>
      <p class="largo">
        Información adicional de la actuación con
        detalles relevantes para el público.
      </p>
      <a href="../pages/proyectos.php#ms">
         <button class="t2">Saber más</button>
      </a>
    </div>
  </div>
</div>
<button class="scroll-arrow" id="scrollArrow" aria-label="Subir">↑</button>
<script src="../assets/js/scroll-arrow.js"></script>
<?php include 'includes/footer.php'; ?>

<!--CONEXION CON JAVA-->
<script src="assets/js/carruselindex.js"></script>
<script src="../../assets/js/nosotron_card.js"></script>
<script src="../../assets/js/proyectos_card.js"></script>

</body>
</html>