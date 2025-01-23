let prevScrollPos = window.pageYOffset;
const navbar = document.getElementById('navbar');
const scrollToTopBtn = document.getElementById('scrollToTopBtn');
const burger = document.getElementById('burger');
const navLinks = document.getElementById('navLinks');

// Hide navbar when scrolling down, show when scrolling up
window.onscroll = function () {
    let currentScrollPos = window.pageYOffset;

    // Toggle the navbar visibility based on scroll direction
    if (prevScrollPos > currentScrollPos) {
        navbar.style.top = "0";
    } else {
        navbar.style.top = "-80px";
    }

    prevScrollPos = currentScrollPos;

    // Show or hide the scroll-to-top button
    if (currentScrollPos > 300) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
};

// Scroll to the top when the button is clicked
scrollToTopBtn.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
};

// Toggle burger menu
burger.addEventListener('click', function () {
    burger.classList.toggle('active');
    navLinks.classList.toggle('show');
});

window.addEventListener("scroll", function () {
    // Hauteur totale de la page
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  
    // Distance défilée
    const scrollTop = document.documentElement.scrollTop;
  
    // Pourcentage de défilement
    const scrollPercentage = (scrollTop / scrollHeight) * 100;
  
    // Mettre à jour la largeur de la barre de progression
    document.querySelector(".progress").style.width = scrollPercentage + "%";
  });
  



  window.addEventListener('scroll', () => {
    // Calcul de la position de défilement par rapport à la hauteur totale
    const scrollTop = window.scrollY; // Pixels défilés
    const windowHeight = window.innerHeight; // Hauteur de la fenêtre
    const documentHeight = document.body.scrollHeight; // Hauteur totale du document

    // Calcul du ratio de défilement (entre 0 et 1)
    const scrollRatio = scrollTop / (documentHeight - windowHeight);

    // Modification dynamique de l'opacité
    const opacity = 1 - scrollRatio; // Réduit l'opacité au fil du défilement
    document.body.style.setProperty('--dynamic-opacity', opacity);
});