var burger_menue = document.querySelector("header .burger-menue"),
nav = document.querySelector("header nav");

burger_menue.onclick = function(){
    burger_menue.classList.toggle("show");
    nav.classList.toggle("show");
}