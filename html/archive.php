<?php

  $num_articoli = 80;  //va inserito un COUNT degli articoli, per capire quante pagine creare

  //il mega array che contiene gli array più piccoli degli articoli
  $articoli = array();


  for($i = 0; $i < $num_articoli; $i++ ){
    $img_index = $i%5; //unicamente per la resa ripetitiva delle immagini
    $articoli[$i] = array(
      "id" => "id_articolo", //l'id per fare il collegamento alla pagine che carica  l'articolo quando viene cliccato
      "author" => "Autore", 
      "date" => "data", //tempo trascorso dalla pubblicazione, da calcolare  
      "title" => "ARTICOLO NUMERO $i", 
      "imgSrc" => "../images/ARTICOLO$img_index.png"); 
  }

  $json = json_encode($articoli);
  echo "<script>
          let articlesContent = $json;
          let numberOfArticles = $num_articoli;  
        </script>";
?>


<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/archive.css">

    <title>Tuttofila - Archivio</title>
  </head>
  <body>

    <header>
      <div>
        <button class="open-sidebar-btn">
          <img class="hamburger-menu" src="../images/hamburger-menu.png">
          <img class="logo-scuola" src="../images/logo.png">
        </button>

        <div class="logo-tutto-fila flex-center">
          <img src="../images/tutto-fila.png">
        </div>
      </div>

      <div class="pages">
        <a class="page-link" href="index.html">
          <div>
            <img src="../images/house-icon.png">
          </div>
          <label>HOME</label>
        </a>
        <a class="page-link" href="archive.html">
          <div>
            <img src="../images/archive-icon.png">
          </div>
          <label>ARCHIVIO</label>          
        </a>
        <a class="page-link" href="about.html">
          <div>
            <img src="../images/redaction-icon.png">
          </div>
          <label>REDAZIONE</label>          
        </a>
        <a class="page-link" href="write.html">
          <div>
            <img src="../images/write-icon.png">
          </div>
          <label>SCRIVI TU</label>          
        </a>
      </div>

      <div class="search-bar">
        <input class="mobile-search-input" type="text">
        <div><img src="../images/search-icon.png"></div>
        <input class="pc-search-input" type="text">
      </div>
    </header>

    <button class="screen-darkener"> </button>
    <div class="spacer"></div>
    <div class="sidebar">
      <div class="pages">
        <a class="page-link" href="index.html">
          <div>
            <img src="../images/house-icon.png">
          </div>
          <label>HOME</label>
        </a>
        <a class="page-link" href="archive.html">
          <div>
            <img src="../images/archive-icon.png">
          </div>
          <label>ARCHIVIO</label>          
        </a>
        <a class="page-link" href="about.html">
          <div>
            <img src="../images/redaction-icon.png">
          </div>
          <label>REDAZIONE</label>          
        </a>
        <a class="page-link" href="write.html">
          <div>
            <img src="../images/write-icon.png">
          </div>
          <label>SCRIVI TU</label>          
        </a>
      </div>
    </div>

    <main>
      <button class="archive-back">
        <img src="../images/arrow-icon.png">
      </button>

      <div  class="archive-tabs">
        <div class="archive-tab" id="1"></div>
        <div class="archive-tab" id="2"></div>
        <div class="archive-tab" id="3"></div>
      </div>

      <button class="archive-forward">
        <img src="../images/arrow-icon.png">
      </button>
    </main>

    
    <script src="../scripts/header.js"></script>
    <script src="../scripts/archive.js"></script>
  </body>
</html>