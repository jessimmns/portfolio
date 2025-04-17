// Fonction pour activer le défilement fluide
function scrollToSection(id) {
    document.querySelector(id).scrollIntoView({
        behavior: 'smooth'
    });
}

// Fonction pour changer la couleur du header lorsque l'on fait défiler la page
window.onscroll = function() {
    changeHeaderColor();
};

function changeHeaderColor() {
    var header = document.getElementById("header");
    if (window.scrollY > 50) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
}
