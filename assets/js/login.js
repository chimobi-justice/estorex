let email = document.getElementById('email');
let emailErr = document.getElementById('emailFeedBack');
let psw = document.getElementById('psw');
let pswErr = document.getElementById('pswFeedBack');
let errResponseText = document.getElementById('errResponseText');


const handleLoginFeeds = () => {
    if (email.value.length > 0) {
        emailErr.textContent = '';
    } 
    if (psw.value.length > 0) {
        pswErr.textContent = '';
    } 
}
email.addEventListener('keyup', handleLoginFeeds);
psw.addEventListener('keyup', handleLoginFeeds);


const loading = () => {
    if (handleLoginBtn) {
        handleLoginBtn.addEventListener('click', () => {
            handleLoginBtn.textContent = 'loading...';
        });
    }
}

window.onload = loading;


if (errResponseText) {
    setTimeout(() => {
        errResponseText.remove();
    }, 3000)
}