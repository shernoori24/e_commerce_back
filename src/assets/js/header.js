let prevScrollPos = window.pageYOffset;
const navbar = document.getElementById('navbar');
const scrollToTopBtn = document.getElementById('scrollToTopBtn');
const burger = document.getElementById('burger');
const navLinks = document.getElementById('navLinks');

// Gestion de la visibilité de la navbar
window.onscroll = function () {
    let currentScrollPos = window.pageYOffset;

    if (prevScrollPos > currentScrollPos) {
        navbar.style.top = "0";
    } else {
        navbar.style.top = "-80px";
    }

    prevScrollPos = currentScrollPos;

    // Affichage du bouton de retour en haut
    if (currentScrollPos > 300) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
};

// Défilement vers le haut
scrollToTopBtn.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
};

// Gestion du menu burger
burger.addEventListener('click', function () {
    burger.classList.toggle('active');
    navLinks.classList.toggle('show');
});

// Gestion de la barre de progression
window.addEventListener("scroll", function () {
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollTop = document.documentElement.scrollTop;
    const scrollPercentage = (scrollTop / scrollHeight) * 100;
    document.querySelector(".progress").style.width = scrollPercentage + "%";
});
