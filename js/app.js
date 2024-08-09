
// Small screen slide out hamburger menu
const menuContainer = document.querySelector(".menu-container");
menuContainer.addEventListener('click', function(event) {
  if (event.target.classList.contains('menu-icon')) {
    menuContainer.classList.toggle('menu-container--collapsed');
  }
});