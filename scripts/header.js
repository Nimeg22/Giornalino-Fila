hamburgerMenuButton = document.querySelector('.open-sidebar-btn');

sidebar = document.querySelector('.sidebar');
spacer = document.querySelector('.spacer');
logoScuola = document.querySelector('.logo-scuola');
logoTuttoFila = document.querySelector('.logo-tutto-fila');
screenDarkener =document.querySelector('.screen-darkener');

sidebarRelated = [
  sidebar,
  spacer,
  logoScuola,
  logoTuttoFila,
  screenDarkener
]

mobileSearchInput = document.querySelector('.search-bar .mobile-search-input')
searchBar = document.querySelector('.search-bar')


hamburgerMenuButton.addEventListener('click', () => {showSidebar()});


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


screenDarkener.addEventListener('click', () => {screenDarkenerPress()});

function screenDarkenerPress(){
  if(searchBar.classList.contains('cover')){
    searchBar.classList.remove('cover')
    screenDarkener.classList.remove('cover')
  }
  if(sidebar.classList.contains('sidebar-visible')){
    sidebarRelated.forEach(element => {
      element.classList.remove('sidebar-visible')
    });
  }
}


mobileSearchInput.addEventListener('click', () => {searchBarCover()});

function searchBarCover(){
  if(searchBar.classList.contains('cover')){
    searchBar.classList.remove('cover')
    screenDarkener.classList.remove('cover')
  } else {
    searchBar.classList.add('cover')
    screenDarkener.classList.add('cover')
  }
}

