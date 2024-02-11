hamburgerMenuButton = document.querySelector('.hamburger-menu');

sidebar = document.querySelector('.sidebar');
spacer = document.querySelector('.spacer');
main = document.querySelector('main');
logoScuola = document.querySelector('.logo-scuola');
screenDarkener =document.querySelector('.screen-darkener');

sidebarRelated = [
  sidebar,
  spacer,
  main,
  logoScuola,
  screenDarkener
]



hamburgerMenuButton.addEventListener('click', () => {showSidebar()});
screenDarkener.addEventListener('click', () => {showSidebar()});

function showSidebar(){
  if(sidebar.classList.contains('sidebar-visible')) {
    sidebarRelated.forEach(element => {
      element.classList.remove('sidebar-visible')
    });
  } else {
    sidebarRelated.forEach(element => {
      element.classList.add('sidebar-visible')
    });
  }
}
