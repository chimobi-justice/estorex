let email = document.getElementById('email');
let emailErr = document.getElementById('emailFeedBack');
let psw = document.getElementById('psw');
let pswErr = document.getElementById('pswFeedBack');
let errResponseText = document.getElementById('errResponseText');


const userSignupFeeds = () => {
    if (email.value.length > 0) {
        emailErr.textContent = '';
    } 
    if (psw.value.length > 0) {
        pswErr.textContent = '';
    } 
}
email.addEventListener('keyup', userSignupFeeds);
psw.addEventListener('keyup', userSignupFeeds);

if (errResponseText) {
    setTimeout(() => {
        errResponseText.remove();
    }, 3000)
}