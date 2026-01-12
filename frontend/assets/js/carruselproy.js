const swiper = new Swiper(".swiper", {
  direction: "horizontal",
  loop: false,
  speed: 1500,
  slidesPerView: 4,
  spaceBetween: 60,
  mousewheel: true,
  parallax: true,
  centeredSlides: true,

  effect: "coverflow",
  coverflowEffect: {
    rotate: 40,
    slideShadows: true,
  },

  autoplay: {
    delay: 2000,
    pauseOnMouseEnter: true,
    disableOnInteraction: false,
  },

  scrollbar: {
    el: ".swiper-scrollbar",
    draggable: true,
  },

  breakpoints: {
    0: { slidesPerView: 1 },
    600: { slidesPerView: 2 },
    1000: { slidesPerView: 3 },
    1400: { slidesPerView: 4 },
    2300: { slidesPerView: 5 },
    2900: { slidesPerView: 6 },
  },
});

/* Pausar autoplay al entrar en una card */
document.querySelectorAll(".swiper-slide").forEach(slide => {
  slide.addEventListener("mouseenter", () => swiper.autoplay.stop());
  slide.addEventListener("mouseleave", () => swiper.autoplay.start());
});

/* Reanudar autoplay al salir del swiper */
document.querySelector(".swiper").addEventListener("mouseleave", () => {
  swiper.autoplay.start();
});
