document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.href; // Récupère l'URL actuelle
    var links = document.querySelectorAll('.active-link a'); // Sélectionne uniquement les liens dans .active-link

    links.forEach(function(link) {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active'); // Ajoute la classe active au lien correspondant
        }
    });
});