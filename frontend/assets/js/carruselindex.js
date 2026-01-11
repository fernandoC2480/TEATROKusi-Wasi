const items = document.querySelectorAll('.item');
const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
let current = 0;
let autoplayInterval;

function showSlide(index, direction) {
    items.forEach((item, i) => {
        item.classList.remove('active', 'to-left', 'to-right', 'from-left', 'from-right');
        if (i === index) {
            item.classList.add('active');
            if (direction === 'next') item.classList.add('from-right');
            if (direction === 'prev') item.classList.add('from-left');
            setTimeout(() => {
                item.classList.remove('from-right', 'from-left');
            }, 20);
        } else if (i === current) {
            if (direction === 'next') item.classList.add('to-left');
            if (direction === 'prev') item.classList.add('to-right');
        }
    });
    current = index;
}

function autoplay() {
    let newIndex = (current + 1) % items.length;
    showSlide(newIndex, 'next');
}

function startAutoplay() {
    autoplayInterval = setInterval(autoplay, 5000);
}

function resetAutoplay() {
    clearInterval(autoplayInterval);
    startAutoplay();
}

next.addEventListener('click', () => {
    let newIndex = (current + 1) % items.length;
    showSlide(newIndex, 'next');
    resetAutoplay();
});

prev.addEventListener('click', () => {
    let newIndex = (current - 1 + items.length) % items.length;
    showSlide(newIndex, 'prev');
    resetAutoplay();
});

// Inicializar
showSlide(current);
startAutoplay();