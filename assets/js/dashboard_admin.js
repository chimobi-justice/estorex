let header_admin_menu_icon = document.getElementById('menu_icon');
let dashboard_admin_aside_nav = document.querySelector('.aside_nav');

header_admin_menu_icon.onclick = () => dashboard_admin_aside_nav.style.display = 'block';
// if (header_admin_menu_icon) {
//     alert('yep');
// }