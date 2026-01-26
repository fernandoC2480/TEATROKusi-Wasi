

document.addEventListener("DOMContentLoaded", () => {

  const cards = document.querySelectorAll(".actuacion");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
        observer.unobserve(entry.target); // solo una vez
      }
    });
  }, {
    threshold: 0.15
  });

  cards.forEach((card, index) => {
    // delay ceremonial
    card.style.transitionDelay = `${index * 120}ms`;
    observer.observe(card);
  });

});
