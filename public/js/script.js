function toggleMenu() {
    var menu = document.querySelector('.nav_mobile');
    var overlay = document.querySelector('.mobile-overlay');
    // Ajoute ou supprime la classe 'active' du menu
    menu.classList.toggle('active');
    overlay.classList.toggle('active'); // Ajoute ou supprime la classe 'active' de l'overlay
}
