const cards = document.querySelectorAll(".reveal-card");

const observer = new IntersectionObserver(
  entries => {
    entries.forEach(entry => {
      entry.target.classList.toggle("active", entry.isIntersecting);
    });
  },
  {
    threshold: 0.5
  }
);

cards.forEach(card => observer.observe(card));
