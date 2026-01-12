

// uiia


// Detiene el carrusel cuando el cursor entra en una tarjeta
const slides = document.querySelectorAll(".swiper-slide");
const swiperContainer = document.querySelector(".swiper");

slides.forEach((slide) => {
  slide.addEventListener("mouseenter", () => {
    swiper.autoplay.stop();
  });

  slide.addEventListener("mouseleave", () => {
    swiper.autoplay.start();
  });
});

// Inicia el autoplay cuando el cursor sale completamente del carrusel
swiperContainer.addEventListener("mouseleave", () => {
  swiper.autoplay.start();
});
