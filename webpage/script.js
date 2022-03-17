const signIn = document.querySelector(".sign-in");
const form = document.querySelector(".admin-form");
const adminLogo = document.querySelector(".admin-logo");
const loading = document.querySelector(".loading");

signIn.addEventListener('click',function(e){
    e.preventDefault();

    document.querySelector('.errorMessage').classList.add('hideDisplay');
    form.classList.add('hideDisplay');
    adminLogo.classList.add('hideDisplay');

    loading.style.display = "flex";
    document.querySelector('.logging-in').style.display = 'block';
    setTimeout(()=>{
        form.submit();
    },2000)
 
})