let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>
{
    searchForm.classList.toggle('active');
    shopingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

let shopingCart = document.querySelector('.shoping-cart');

document.querySelector('#cart-btn').onclick = () =>
{
    searchForm.classList.remove('active');
    shopingCart.classList.toggle('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

let loginForm = document.querySelector('.form_box');

document.querySelector('#login-btn').onclick = () =>
{
    searchForm.classList.remove('active');
    shopingCart.classList.remove('active');
    loginForm.classList.toggle('active');
    navbar.classList.remove('active');
    
}

let navbar = document.querySelector('.navbar');

document.querySelector('#menus-btn').onclick = () =>
{
    searchForm.classList.remove('active');
    shopingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.toggle('active');

}
window.onscroll = () => 
{
    searchForm.classList.remove('active');
    shopingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}



//Swipper code


var swiper = new Swiper(".product-slider", {
  slidesPerView: 3,
  spaceBetween: 20,

  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});












var swiper = new Swiper(".review-slider", {
  
  slidesPerView: 1,
  spaceBetween: 20,
  autoplay: {
    delay: 5000
    
  },
  
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});











var swiper = new Swiper(".indoor-slider", {
  
  slidesPerView: 3,
  spaceBetween: 20,
  
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1020: {
      slidesPerView: 3,
    },
  },
});

var x=document.getElementById("login");
var y=document.getElementById("register");
var z=document.getElementById("btn_sign_up");

function register()
{
  x.style.left="-400px";
  y.style.left="50px";
  z.style.left="110px";
}

function login()
{
  x.style.left="50px";
  y.style.left="450px";
  z.style.left="0px";

}




let subMenu = document.getElementById("subMenu");

function toggleMenu()
{
    subMenu.classList.toggle("open-menu");
}