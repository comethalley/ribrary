const signIn = document.querySelector(".sign-in");
const form = document.querySelector(".admin-form");
const adminLogo = document.querySelector(".admin-logo");
const loading = document.querySelector(".loading");
const errorMessage = document.querySelector('.errorMessage');

signIn.addEventListener('click',function(e){
    e.preventDefault();

    form.classList.add('hideDisplay');
    adminLogo.classList.add('hideDisplay');
    if(errorMessage){
        errorMessage.classList.add('hideDisplay');
    }
  
    loading.style.display = "flex";
    document.querySelector('.logging-in').style.display = 'block';

    setTimeout(()=>{
        form.submit();
    },2000)

    
 
})

// window.onload = function(){
//     if(errorMessage){
//         errorMessage.classList.add('hideDisplay');
//     }
// }

