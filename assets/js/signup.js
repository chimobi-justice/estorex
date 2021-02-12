let form = document.getElementById('signup');
let fName = document.getElementById('firstname');
let fNameErr = document.getElementById('firstNameFeedBack');
let lName = document.getElementById('lastname');
let lNameErr = document.getElementById('lastNameFeedBack');
let email = document.getElementById('email');
let emailErr = document.getElementById('emailFeedBack');
let psw = document.getElementById('psw');
let pswErr = document.getElementById('pswFeedBack');
let successResponseText = document.getElementById('successResponseText');



const userSignupFeeds = () => {
    if (fName.value.length > 0) {
        fNameErr.textContent = '';
    } 
    if (lName.value.length > 0) {
        lNameErr.textContent = '';
    } 
    if (email.value.length > 0) {
        emailErr.textContent = '';
    } 
    if (psw.value.length > 0) {
        pswErr.textContent = '';
    } 
}
fName.addEventListener('keyup', userSignupFeeds);
lName.addEventListener('keyup', userSignupFeeds);
email.addEventListener('keyup', userSignupFeeds);
psw.addEventListener('keyup', userSignupFeeds);

if (successResponseText) {
    setTimeout(() => {
        successResponseText.remove();
    }, 5000)
}



