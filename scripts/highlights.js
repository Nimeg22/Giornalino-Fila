
const cursor = document.querySelector('.cursor div');
const cursorContainer = document.querySelector('.cursor')
const articleImg = document.querySelector('.feed-highlights .article img')
const articleTitle = document.querySelector('.feed-highlights .article-title')
const articleDescription = document.querySelector('.feed-highlights .article-description')


const articleList = []

for(let i=1; i<=10; i++){
  n = i.toString()
  article = {
    imgSrc: '../images/ARTICOLO'+n+'.png',
    title: "ARTICOLO " +n,
    author: 'autore articolo' +n,
    description: 'descrizione articolo '+n
  }
  articleList.push(article)
}


updateArticle(0)

var reset = 0
iterationId = setInterval(()=>{autoScroll(1)}, 4000);


function updateArticle(index){
  articleImg.src = articleList[index].imgSrc;
  articleTitle.innerHTML = articleList[index].title
  articleDescription.innerHTML = articleList[index].description
  
}

function autoScroll(sign)  {
    reset == 0 && sign==1 && cursor.classList.add('animated');
    setTimeout(() => {
      var padding = getComputedStyle(cursorContainer).paddingLeft;
      
      // console.log(padding)
      
      padding = padding.slice(0, padding.length-2);
      
      // console.log(padding)
      paddingInt = parseInt(padding)
      
      paddingInt = reset == 1 && sign==1 ? reset = 0 : paddingInt +(sign*20) 
      updateArticle(paddingInt/20)
      padding = paddingInt.toString() + 'px';

      cursorContainer.style.setProperty('padding-left', padding);
      
      if(padding == '180px'&&sign==1){
        
        setTimeout(()=>{updateArticle(0);cursorContainer.style.setProperty('padding-left', '0px');},1000);
        reset = 1;  
      }else if(padding=='0px'&&sign==-1){
        setTimeout(()=>{cursorContainer.style.setProperty('padding-left', '180px');},2000);
        reset = 1;  }
      
      cursor.classList.remove('animated');
    }, 500)
}

var timeoutId;
function skip(sign) {
  clearInterval(iterationId);
  clearTimeout(timeoutId);
  autoScroll(sign);
  timeoutId = setTimeout(()=>{ iterationId = setInterval(() => {autoScroll(1)}, 4000);}, 2000);
}