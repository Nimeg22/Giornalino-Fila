const contentInput = document.querySelector('.content-input')
const form = document.querySelector('form')
let formButton;

const labels = [
  'intervista',
  'in lingua',
  'politica studentesca',
  'fatti dal mondo',
  'salute e benessere',
  'editoriale'
]


function buildForm() {
  let articleContent = contentInput.value;
  
  form.innerHTML = `
    <label>titolo</label>
    <input class="article-title-input" type="text" name="title">
    <label>Autore</label>
    <input class="article-author-input" type="text" name="author">
    <label>Data di pubblicazione</label>
    <input class="article-date-input" type="date" name="uploadDate">
    <label>Descrizione</label>
    <input class="article-date-input" type="text" name="description">
    <label>Corpo dell'articolo</label>
  `

  numOfParagraphs=0;
  articleContent = articleContent.split('\n').filter(n => n)
  console.log(articleContent)
  for(let i= 0; i<articleContent.length;i++){
    // console.log(paragraph);
    paragraph = articleContent[i];
    
    form.innerHTML += `
      <div class="paragraph-div">
        <div id="paragraph${i}">${paragraph}</div>
        <input class="paragraph" type="text" name="paragraph${i}">
        <input type="checkbox" name="checkbox${i}" id="checkbox${i}">
      </div>
    `
      numOfParagraphs++;
  }
  


  form.innerHTML += `
    <label>URL thumbnail</label>
    <input class="article-thumbnailImg-input" type="text" name="thumbnailImage">
    <label>URL immagine principale</label>
    <input class="article-articleImg-input" type="text" name="articleImage">
    <div class="labels"> 
      <label>
        <input type="checkbox" name="et1" id="label0">
        ${labels[0]}
      </label>
      <label>
        <input type="checkbox" name="et1" id="label1">
        ${labels[1]}
      </label>
      <label>
        <input type="checkbox" name="et1" id="label2">
        ${labels[2]}
      </label>
      <label>
        <input type="checkbox" name="et1" id="label3">
        ${labels[3]}
      </label>
      <label>
        <input type="checkbox" name="et1" id="label4">
        ${labels[4]}
      </label>
      <label>
        <input type="checkbox" name="et1" id="label5">
        ${labels[5]}
      </label>
    </div>

    <button type="submit" class="form-button">Post</button>  
  `

  formButton = document.querySelector('.form-button')
  console.log(formButton)

  
  formButton.addEventListener('click', event => {

    event.preventDefault();

    const formData = new FormData(form); // Create a FormData object with the form data
    
    for (let i = 0; i<numOfParagraphs; i++) {
      let paragraph 
      console.log(i)
      if(document.getElementById(`checkbox${i}`).checked){
        paragraph =  '<b>' + document.getElementById(`paragraph${i}`).innerHTML + '</b>'
      } else {
        paragraph = document.getElementById(`paragraph${i}`).innerHTML
      }
      formData.set(`paragraph${i}`, escapeHtml(paragraph))
      
    }


    let data = {}
    data['numOfParagraphs'] = numOfParagraphs
    for (const key of formData.keys()) {
      keyCheck = key.substring(0, key.length - 1);
      keyCheck2 = key.substring(0, key.length - 2);
      if (keyCheck != 'checkbox' && keyCheck != 'et' && keyCheck2 != 'checkbox') {
        data[key] = formData.get(key);
      }
    }

    for (let i = 0; i < labels.length; i++) {
      const label = document.getElementById('label' + i);
      data[labels[i]] = label.checked;
    }

    document.body.innerHTML += JSON.stringify(data);
    document.body.innerHTML += '<a href="../html/updateDatabase.php"><button>Carica</button></a>'

  })
}

function escapeHtml(html) { 
  return html.replace(/</g, '&lt;').replace(/>/g, '&gt;'); 
} 