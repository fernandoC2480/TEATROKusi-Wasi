const options = document.querySelectorAll(".option");
let current = 0;
let interval = null;
let paused = false;

function activate(index) {
  options.forEach(o => o.classList.remove("active"));
  options[index].classList.add("active");
}

function startAccordion() {
  interval = setInterval(() => {
    if (paused) return;
    current = (current + 1) % options.length;
    activate(current);
  }, 3500);
}

options.forEach((option, index) => {

  option.addEventListener("mouseenter", () => {
    paused = true;
    activate(index);
  });

  option.addEventListener("mouseleave", () => {
    paused = false;
  });

});

// iniciar
activate(0);
startAccordion();
