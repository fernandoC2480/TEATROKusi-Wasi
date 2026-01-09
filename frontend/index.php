<?php
include 'includes/header.php';
?>
<!--link de estilos CSS para el carrusel y el cuerpo de la página -->
<link rel="stylesheet" href="assets/css/carruselindex.css">
<link rel="stylesheet" href="assets/css/cuerpo_index.css">
<link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caesar+Dressing&display=swap" rel="stylesheet">
<!--inicio de carrusel NO TOCAR porque funciona con fe-->
<body>
<div class="contenedor">
    <div class="slide">
        <div class="item" style="background-image: url(../assets/img/carrusel2.png);">
            <div class="content">
                <div class="name">Switzerland</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel5.png);">
            <div class="content">
                <div class="name">Finland</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel3.png);">
            <div class="content">
                <div class="name">Iceland</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel4.png);">
            <div class="content">
                <div class="name">Australia</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel2.jpg);">
            <div class="content">
                <div class="name">Netherland</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
            </div>
        </div>
        <div class="item" style="background-image: url(../assets/img/carrusel3.png);">
            <div class="content">
                <div class="name">Ireland</div>
                <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                <button>See More</button>
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
        <img src="../assets/img/cartas.jpg" alt="Actuación 1">

            <div class="info">
                <h3>DIOS DE LA TIERRA</h3>

                    <p class="texto-corto">
                        La fuerxa de la tierra.
                    </p>

                    <p class="texto-largo">
                        Aquí va una descripción más extensa con detalles,
                        fechas, artistas y contexto cultural del evento.
                    </p>

                    <button>Saber más</button>
                </div>
    </div>
        <div class="actuacion">
                <img src="../assets/img/carta2.jpg" alt="Actuación 2">

                <div class="info">
                    <h3>LA BELLEZA DEL AGUA</h3>

                    <p class="texto-corto">
                        Peces y ríos.. nadie sabe quien los cuida.
                    </p>

                    <p class="texto-largo">
                        Información adicional de la actuación con
                        detalles relevantes para el público.
                    </p>

                    <button>Saber más</button>
                </div>
        </div>
        <div class="actuacion">
                <img src="../assets/img/carta3.jpg" alt="Actuación 3">

                <div class="info">
                    <h3>PRIMAL
                    </h3>

                    <p class="texto-corto">
                        Nadie te salvara, demarra sangre y pelea por vivir...
                    </p>

                    <p class="texto-largo">
                        Descripción ampliada de la experiencia cultural,
                        artistas invitados y programación.
                    </p>

                    <button>Saber más</button>
        </div>
    </div>    
</div>
<!--titulo 2-->
<div class="titulo2">
        <img src="../assets/img/decoracion_nosotros.png" alt="patrones" class="patron">
        <img src="../assets/img/decoracion_nosotros.png" alt="patrones" class="patron1">
        <h1 class="texto-titulo2">Nosotros</h1>
</div> 
</body>
<!--CONEXION CON JAVA-->
<script src="assets/js/carruselindex.js"></script>
<!--fin DEL BODY-->

<?php
include 'includes/footer.php';
?>