const cursor = document.querySelector('.cursor div');
const cursorContainer = document.querySelector('.cursor');
const backButton = document.querySelector('.tab-back');
const forwardButton = document.querySelector('.tab-forward');
const tabs = document.querySelectorAll('.tab')



const highlightsArticleHtml = {
  authorAndTime: document.querySelector('.highlights .article-data'),
  title: document.querySelector('.highlights .article-title'),
  description: document.querySelector('.highlights .article-description'),
  img: document.querySelector('.highlights .article img')
}

// const articlesContent = [
//   {
//     author: 'Alessandro Metz 1F',
//     time: '15h',
//     title: 'LIM O LAVAGNA IN ARDESIA? TU CHE NE DICI?',
//     description: 'Al giorno d\'oggi la Lim sta spodestando la lavagna in ardesia diventando la più utilizzata per le sue varie qualità, ma cosa ne pensano gli studenti?',
//     imgSrc: '../images/ARTICOLO0.png'
//   },
//   {
//     author: 'Samuele Colautti 1F',
//     time: '3g',
//     title: 'DDI: PERCHÉ NO?',
//     description: 'Appunto, perché? La DDI (Didattica Digitale Integrata) è stata un’ottima soluzione nei tempi più critici della pandemia da COVID-19: ha infatti permesso a studenti e alunni di proseguire le lezioni anche quando non sembrava più possibile, permettendo al sistema scolastico italiano di subire meno danni possibile',
//     imgSrc: '../images/ARTICOLO1.png'
//   },
//   {
//     author: 'Redazione 2023',
//     time: '2g',
//     title: 'LA PRESIDE SI RACCONTA',
//     description: 'Vi siete mai chiesti cosa si nasconda dietro al ruolo di Dirigente scolastica? Beh noi della classe 1^F si! Per questo abbiamo chiesto alla dottoressa Carla Bianchi se fosse disponibile a rispondere alle nostre domande.',
//     imgSrc: '../images/ARTICOLO2.png'
//   },
//   {
//     author: 'Alessandro Metz 1F',
//     time: '15h',
//     title: 'LIM O LAVAGNA IN ARDESIA? TU CHE NE DICI?',
//     description: 'Al giorno d\'oggi la Lim sta spodestando la lavagna in ardesia diventando la più utilizzata per le sue varie qualità, ma cosa ne pensano gli studenti?',
//     imgSrc: '../images/ARTICOLO3.png'
//   },
//   {
//     author: 'Samuele Colautti 1F',
//     time: '3g',
//     title: 'DDI: PERCHÉ NO?',
//     description: 'Appunto, perché? La DDI (Didattica Digitale Integrata) è stata un’ottima soluzione nei tempi più critici della pandemia da COVID-19: ha infatti permesso a studenti e alunni di proseguire le lezioni anche quando non sembrava più possibile, permettendo al sistema scolastico italiano di subire meno danni possibile',
//     imgSrc: '../images/ARTICOLO4.png'
//   },
//   {
//     author: 'Redazione 2023',
//     time: '2g',
//     title: 'LA PRESIDE SI RACCONTA',
//     description: 'Vi siete mai chiesti cosa si nasconda dietro al ruolo di Dirigente scolastica? Beh noi della classe 1^F si! Per questo abbiamo chiesto alla dottoressa Carla Bianchi se fosse disponibile a rispondere alle nostre domande.',
//     imgSrc: '../images/ARTICOLO5.png'
//   },
//   {
//     author: 'Alessandro Metz 1F',
//     time: '15h',
//     title: 'LIM O LAVAGNA IN ARDESIA? TU CHE NE DICI?',
//     description: 'Al giorno d\'oggi la Lim sta spodestando la lavagna in ardesia diventando la più utilizzata per le sue varie qualità, ma cosa ne pensano gli studenti?',
//     imgSrc: '../images/ARTICOLO6.png'
//   },
//   {
//     author: 'Samuele Colautti 1F',
//     time: '3g',
//     title: 'DDI: PERCHÉ NO?',
//     description: 'Appunto, perché? La DDI (Didattica Digitale Integrata) è stata un’ottima soluzione nei tempi più critici della pandemia da COVID-19: ha infatti permesso a studenti e alunni di proseguire le lezioni anche quando non sembrava più possibile, permettendo al sistema scolastico italiano di subire meno danni possibile',
//     imgSrc: '../images/ARTICOLO7.png'
//   },
//   {
//     author: 'Redazione 2023',
//     time: '2g',
//     title: 'LA PRESIDE SI RACCONTA',
//     description: 'Vi siete mai chiesti cosa si nasconda dietro al ruolo di Dirigente scolastica? Beh noi della classe 1^F si! Per questo abbiamo chiesto alla dottoressa Carla Bianchi se fosse disponibile a rispondere alle nostre domande.',
//     imgSrc: '../images/ARTICOLO8.png'
//   },
//   {
//     author: 'Samuele Colautti 1F',
//     time: '3g',
//     title: 'DDI: PERCHÉ NO?',
//     description: 'Appunto, perché? La DDI (Didattica Digitale Integrata) è stata un’ottima soluzione nei tempi più critici della pandemia da COVID-19: ha infatti permesso a studenti e alunni di proseguire le lezioni anche quando non sembrava più possibile, permettendo al sistema scolastico italiano di subire meno danni possibile',
//     imgSrc: '../images/ARTICOLO9.png'
//   }
// ]



initializeHomePage()
const changeDelay = 8000;



let articleIndex = 0


forwardButton.addEventListener('click', () => {
  clearInterval(intervalID);
  changeArticle(1);
  intervalID = setInterval(() => {changeArticle(1)}, changeDelay);
})

backButton.addEventListener('click', () => {
  clearInterval(intervalID);
  changeArticle(-1);
  intervalID = setInterval(() => {changeArticle(1)}, changeDelay);
})

intervalID = setInterval(() => {changeArticle(1)}, changeDelay);

tabs.forEach(element => {
  element.addEventListener('click', (event) => {
    clearInterval(intervalID);

    elementId = event.srcElement.id

    direction =  elementId > articleIndex ? 1 : -1

    let distance = direction*(elementId - articleIndex)

    articleIndex = parseInt(elementId)

    let margin = '-1px'
    let width = '10px';

    margin = addPx(margin, articleIndex*20);
    width = addPx(width, distance*20)
    
    cursor.style.setProperty('width', width);
    
    if(direction == -1){
      cursorContainer.style.setProperty('margin-left', margin);
    }
  
    setTimeout(() => {
      width = addPx(width, -distance*20)
      cursor.style.setProperty('width', width);
      if(direction == 1){
        cursorContainer.style.setProperty('margin-left', margin);
      }

    updateArticle(articleIndex)
    
    intervalID = setInterval(() => {changeArticle(1)}, changeDelay);
    }, 300)
  })
});



function initializeHomePage(){
  highlightsArticleHtml.authorAndTime.textContent = articlesContent[0].author + ' · ' + articlesContent[0].uploadDate;
  highlightsArticleHtml.title.textContent = articlesContent[0].title
  highlightsArticleHtml.description.textContent = articlesContent[0].description
  highlightsArticleHtml.img.src = articlesContent[0].thumbnailImgUrl
}

function updateArticle(index) {
  highlightsArticleHtml.authorAndTime.style.setProperty('opacity', '0');
  highlightsArticleHtml.title.style.setProperty('opacity', '0');
  highlightsArticleHtml.description.style.setProperty('opacity', '0');
  
  setTimeout(() => {
    highlightsArticleHtml.authorAndTime.textContent = articlesContent[index].author + ' · ' + articlesContent[index].uploadDate;
    highlightsArticleHtml.title.textContent = articlesContent[index].title
    highlightsArticleHtml.description.textContent = articlesContent[index].description
    highlightsArticleHtml.img.src = articlesContent[index].thumbnailImgUrl

    highlightsArticleHtml.authorAndTime.style.setProperty('opacity', '1');
    highlightsArticleHtml.title.style.setProperty('opacity', '1');
    highlightsArticleHtml.description.style.setProperty('opacity', '1');
  }, 500);
}

function changeArticle(direction) {
  articleIndex += direction;
  if(articleIndex == 10 && direction == 1){
    resetCursor(direction);
  } else if(articleIndex == -1 && direction == -1) {
    resetCursor(direction);
  } else {
    move(direction)
  }
  updateArticle(articleIndex)
}

function resetCursor(direction){
  if (direction == 1) {
    articleIndex = 0;
    cursorContainer.style.setProperty('margin-left', '-1px');
  } else {
    articleIndex = 9;
    cursorContainer.style.setProperty('margin-left', '179px');
  }
}

function move(direction){
  let margin = '-1px'
  let width = '10px';

  margin = addPx(margin, articleIndex*20);
  width = addPx(width, 20)

  cursor.style.setProperty('width', width);

  if(direction == -1){
    cursorContainer.style.setProperty('margin-left', margin);
  }

  setTimeout(() => {
    width = addPx(width, -20)
    cursor.style.setProperty('width', width);
    if(direction == 1){
      cursorContainer.style.setProperty('margin-left', margin);
    }
  }, 300);
}




///////////////////////////////////



function addPx(input, px){
  input = input.slice(0, input.length-2);
  inputInt = parseInt(input)
  inputInt += px
  input = inputInt.toString() + 'px';
  return input
}