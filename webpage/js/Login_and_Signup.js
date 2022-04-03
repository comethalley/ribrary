const signupLink = document.querySelector('.signup-link');
const loginLink = document.querySelector('.login-link')
const loginContainer = document.querySelector('.container')
const signUpContainer = document.querySelector('.container2')

signupLink.addEventListener('click',function(){
    loginContainer.classList.add('removeContainer')
    signUpContainer.classList.add('displayContainer')
})

loginLink.addEventListener('click',function(){
    loginContainer.classList.remove('removeContainer')
    signUpContainer.classList.remove('displayContainer')
})