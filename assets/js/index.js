let loggedIn = document.getElementById('login');
let signUp = document.getElementById('signup');
let copyRight = document.getElementById('copyright');

const logClickBtn = () => {
    if (loggedIn) {
        location.href = './auth/login.php';
    }
}
loggedIn.addEventListener('click', logClickBtn);

const signUpClickBtn = () => {
    if (signUp) {
        location.href = './auth/signup.php';
    }
}
signUp.addEventListener('click', signUpClickBtn);

// get fullyear and update copyright
let d = new Date();
copyRight.textContent = d.getFullYear();
