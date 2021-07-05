let menu_icon = document.getElementById('menu_icon');
let asideNav = document.getElementById('asideNav');

let mobile_menu = document.getElementById('mobile_menu');
let close_menu = document.querySelector('.close_menu');
let hambuger_wrapper_list = document.getElementById('hambuger_wrapper_list');

let copyRight = document.getElementById('copyright');

menu_icon.onclick = () => asideNav.classList.toggle('toggleNav');

if (mobile_menu) {
    mobile_menu.onclick = () => {
        close_menu.style.display = 'block';
        mobile_menu.style.display = 'none';
        hambuger_wrapper_list.classList.toggle('toggleNav');
    }
}

if (close_menu) {
    close_menu.onclick = () => {
        mobile_menu.style.display = 'block';
        close_menu.style.display = 'none';
        hambuger_wrapper_list.classList.toggle('toggleNav');
    }
}

// get fullyear and update copyright
let d = new Date();
copyRight.textContent = d.getFullYear();



