document.addEventListener("DOMContentLoaded", () => {

  const imageCards = document.querySelectorAll(".reveal-img");
  const textBlocks = document.querySelectorAll(".reveal-text");

  /* ===== IMAGEN ===== */
  const imageObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      entry.target.classList.toggle("active", entry.isIntersecting);
    });
  }, {
    threshold: 0.15   // apenas entra
  });

  imageCards.forEach(el => imageObserver.observe(el));

  /* ===== TEXTO ===== */
  const textObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      entry.target.classList.toggle("active", entry.isIntersecting);
    });
  }, {
    threshold: 0.65   // imagen casi completa
  });

  textBlocks.forEach(el => textObserver.observe(el));

});
