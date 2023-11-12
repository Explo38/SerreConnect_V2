// ************************ Navbar ********************************

window.addEventListener("scroll", function () {
    var navbar = document.querySelector(".navbar");
    var windowPosition = window.scrollY > 0;
    navbar.classList.toggle("reduced", windowPosition);
});