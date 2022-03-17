const signIn = document.querySelector(".sign-in");
const form = document.querySelector(".admin-form");

signIn.addEventListener('click',function(e){
    e.preventDefault();
    setTimeout(()=>{
        form.submit()
    },2000)
    console.log("sdsd");
})