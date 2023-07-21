let logo = document.querySelector('.logo');
let menu = document.querySelector('.menu');

logo.addEventListener('click', ()=>{
    menu.classList.toggle('burger');
});