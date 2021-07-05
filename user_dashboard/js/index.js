let copyRight = document.getElementById('copyright');
let arrow = document.querySelector('.arrow');
let openProfileModal = document.getElementById('openProfileModal');
let profileBox = document.getElementById('profileBox');

let menu_icon = document.getElementById('menu_icon');
let asideNav = document.getElementById('asideNav');

// ============ hambuger for mobile ============== //
let mobile_menu = document.getElementById('mobile_menu');
let close_menu = document.querySelector('.close_menu');
let hambuger_wrapper_list = document.getElementById('hambuger_wrapper_list');
let mobileProfileModal = document.getElementById('mobileProfileModal');
let mobileProfileBox = document.getElementById('mobileProfileBox');
let mobileArrow = document.querySelector('.mobileArrow');

// =========== End hambuger =============//

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

const handleProfileClick = () => {
    openProfileModal.onclick = () => {
        if (openProfileModal) {
            arrow.classList.toggle('up');
            profileBox.classList.toggle('toggleProfileBox');
        }
    }
} 

handleProfileClick();

const handleMobileProfileClick = () => {
    mobileProfileModal.onclick = () => {
        if (mobileProfileModal) {
            mobileArrow.classList.toggle('up');
            mobileProfileBox.classList.toggle('toggleProfileBox');
        }
    }
}

handleMobileProfileClick();

// get fullyear and update copyright
let d = new Date();
copyRight.textContent = d.getFullYear();