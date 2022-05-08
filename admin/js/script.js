const signIn = document.querySelector(".sign-in");
const form = document.querySelector(".admin-form");
const adminLogo = document.querySelector(".admin-logo");
const loading = document.querySelector(".loading");
const errorMessage = document.querySelector('.errorMessage');
const createAccount = document.querySelector('.create-account')


// ADMIN SIGN FUNCTION
signIn.addEventListener('click', function (e) {
    e.preventDefault();

    // HIDE LOGO AND FORM
    form.classList.add('hideDisplay');
    adminLogo.classList.add('hideDisplay');
    createAccount.classList.add('hideDisplay');

    // If has error message, hide it
    if (errorMessage) {
        errorMessage.classList.add('hideDisplay');
    }

    // Display loading 
    loading.style.display = "flex";
    document.querySelector('.logging-in').style.display = 'block';
    document.querySelector('.wait').style.display = 'block';

    setTimeout(() => {
        form.submit();
    }, 2000)

})





