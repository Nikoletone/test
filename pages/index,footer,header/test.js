const humburgerButton = document.querySelector(".nav-toggler");

const navigation = document.querySelector("nav");

humburgerButton.addEventListener("click", toggleNav)
function toggleNav(){
    humburgerButton.classList.toggle("active")
    navigation.classList.toggle("active")
}