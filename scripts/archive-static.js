const forwardButton = document.querySelector('.archive-forward')
const backButton = document.querySelector('.archive-back')
const tabContainer = document.querySelector('.archive-tabs')
const tabs = document.querySelectorAll('.archive-tab')
const numberOfArticles = 80;
const articlesContent = [];
let tabNum=1;
let timeoutRunning = false;
let stopwatchStart = 0;


for(let i = 0; i < numberOfArticles; i++ ){
    let imgIndex = i%5; 
    articlesContent.push({
      "id": "id_articolo", 
      "author": "Autore", 
      "date": "data", 
      "title": "ARTICOLO NUMERO " + i, 
      "imgSrc": "../images/ARTICOLO" + imgIndex + ".png"
  })
}

let [numberOfCells, numberOfTabs,  centerTabTranslate, rightTabTranslate, maxArticleHeight] = calculateShiftData()

setTimeout(() => {
  [numberOfCells, numberOfTabs,  centerTabTranslate, rightTabTranslate, maxArticleHeight] = calculateShiftData()
  initializePage()
}, 300);

setInterval(()=>{
  console.log(numberOfCells)
}, 1000)

document.defaultView.addEventListener('resize', () => {
  tabs.forEach(element => {
    element.innerHTML=''})
  setTimeout(()=>{
    [numberOfCells, numberOfTabs,  centerTabTranslate, rightTabTranslate, maxArticleHeight] = calculateShiftData()
    buildArticles(tabNum)
    resetShift(tabNum)
  }, 1)
})

forwardButton.addEventListener('click', () => {
  if(tabNum!==numberOfTabs) {
    backButton.style.setProperty('opacity', 1)
    forwardButton.disabled = true;
    backButton.disabled = true;
    setTimeout(() => {
      shiftTab(rightTabTranslate)
    }, 50);
  } 
  if(tabNum === numberOfTabs-1){forwardButton.style.setProperty('opacity', 0.5)}
})

backButton.addEventListener('click', () => {
  if (tabNum!==1){
    forwardButton.style.setProperty('opacity', 1)
    backButton.disabled = true;
    forwardButton.disabled = true;
    setTimeout(() => {
      shiftTab('0')
    }, 50);
  }
  if(tabNum === 2){backButton.style.setProperty('opacity', 0.5)}
})







////////////////////////////////////////////////

function initializePage() {
  backButton.style.setProperty('opacity', 0.5)
  tabs.forEach(element => {
    element.style.transition = 'transform 0s'
    buildArticles(tabNum)
    element.style.transform = `translateX(${centerTabTranslate})`
    setTimeout(() => {
      element.style.transition = 'transform 0.7s'
    }, 10);
  });
}

function calculateShiftData(){
  const cols = getComputedStyle(tabs[0]).gridTemplateColumns.replace(/[^x]/g, "").length
  const rows =  getComputedStyle(tabs[0]).gridTemplateRows.replace(/[^x]/g, "").length
  const cells = cols*rows
  const numberOfTabs = (numberOfArticles - numberOfArticles%cells) / cells + 1 
  const tabWidth = getComputedStyle(tabContainer).width;
  const centerTabTranslate = addPx('-'+tabWidth, '-30px')
  const rightTabTranslate = addPx(centerTabTranslate, centerTabTranslate)
  const tabGap = getComputedStyle(tabs[0]).gap
  const tabHeight = getComputedStyle(tabs[0]).height
  const maxArticleHeight = dividePx(addPx(tabHeight, '-'+addPx(tabGap, tabGap)), rows)
  return [cells, numberOfTabs, centerTabTranslate, rightTabTranslate, maxArticleHeight]
}

function buildArticles(tabNum) {
  let tabLooper = tabNum
  tabs.forEach(element => {
    element.innerHTML=''
    for(let i = numberOfCells*(tabLooper-2); i < (tabLooper-1)*numberOfCells; i++){
      if (i < numberOfArticles && i >= 0) {
        element.innerHTML+=`
      <div class="article">
        <img src="${articlesContent[i].imgSrc}"> 
        <div class="article-info">
          <label class="article-data">
            ${articlesContent[i].author} &#183; ${articlesContent[i].date}
          </label>
          <label class="article-title">
            ${articlesContent[i].title}
          </label>        
        </div>
      </div>`
      //   element.innerHTML+=`
      // <div class="article">
      //   <img src="../images/ARTICOLO${i%5}.png">
      //   <div class="article-info">
      //     <label class="article-data">
      //       Autore e tempo
      //     </label>
      //     <label class="article-title">
      //       QUESTO é IL CAZZO DI TITOLO DAJJJJE ROMAAAAAA DAJJJEEEE
      //     </label>        
      //   </div>
      // </div>`
      }
    }
    tabLooper++
  });
  document.querySelectorAll('.article').forEach(element => {
    element.style.setProperty('max-height', maxArticleHeight)
  })
  return document.querySelectorAll('.article')
}

function shiftTab(shift) {
  tabs.forEach(element => {
    element.style.transform = `translateX(${shift})`
  });

  if(shift==0){
    tabNum--;
    console.log('back', tabNum)
  } else {
    tabNum++
    console.log('forward', tabNum)
  }
  setTimeout(() => {
    resetShift(tabNum)    
    forwardButton.disabled = false;
    backButton.disabled = false;
  }, 640);
}

function resetShift(tabNum) {
  tabs.forEach(element => {
    element.style.transition = 'transform 0s'
    element.style.transform = `translateX(${centerTabTranslate})`
    buildArticles(tabNum)
    setTimeout(() => {
      element.style.transition = 'transform 0.7s'
    }, 50);
  });
}



///////////////////////////7

function addPx(input, px){
  input = input.slice(0, input.length-2);
  inputFloat = parseFloat(input)
  px = px.slice(0, px.length-2);
  pxFloat = parseFloat(px)
  inputFloat += pxFloat
  input = inputFloat.toString() + 'px';
  return input
}

function dividePx(input, divisor){
  input = input.slice(0, input.length-2);
  inputFloat = parseFloat(input)
  inputFloat = inputFloat/divisor
  input = inputFloat.toString() + 'px';
  return input
}