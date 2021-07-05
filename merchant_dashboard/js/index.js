let mobile_menu = document.getElementById('menu-icon-mobile');
let asideMobileNav = document.querySelector('.aside-nav-mobile');

let closeMenu = document.getElementById('close-icon-mobile');

let response = document.querySelector('.response');

mobile_menu.onclick = () => asideMobileNav.classList.toggle('toggleNav');

closeMenu.onclick = () => asideMobileNav.classList.toggle('toggleNav');

if (response) {
    setTimeout(() => {
        response.remove();
    }, 8000);
}