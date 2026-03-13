let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const indicators = document.querySelectorAll('.indicator');

function showSlide(n) {
    // Masquer toutes les slides
    slides.forEach(slide => {
        slide.classList.remove('active');
    });

    // Retirer la classe active de tous les indicateurs
    indicators.forEach(indicator => {
        indicator.classList.remove('active');
    });

    //Afficher le slide courant
    slides[n].classList.add('active');
    indicators[n].classList.add('active');

    currentSlide = n;
}
function nextSlide() {
    let next = currentSlide + 1;
    if (next >= slides.length) {
        next = 0;
    }
    showSlide(next);
}

function prevSlide() {
    let prev = currentSlide -1;
    if (prev < 0) {
        prev = slides.length -1;
    }
    showSlide(prev);
}

function goToSlide(n) {
    showSlide(n);
}

// Défilement automatique
let autoSlide = setInterval(nextSlide, 5000);

// Arreter le défilement automatique
document.querySelector('.carrousel').addEventListener
('mouseenter', () => {
    clearInterval(autoSlide);
});

// Redémarrer le défilement automatique
document.querySelector('.carrousel').addEventListener
('mouseleave',() => {
    autoSlide = setInterval(nextSlide, 5000);
});

// Navigation au clavier
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        prevSlide();
    } else if (e.key === 'ArrowRight') {
        nextSlide();
    }
});