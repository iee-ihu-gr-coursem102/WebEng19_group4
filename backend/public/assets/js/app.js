document.addEventListener('DOMContentLoaded', () => {
    const menuBurger = document.querySelector('.mobile-menu .lines');
    const mobileMenu = document.querySelector('.mobile-menu .menu-nav');

    menuBurger.addEventListener('click', function() {
        mobileMenu.classList.toggle('show')
    });
});