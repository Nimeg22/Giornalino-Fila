<?php
include("api.php");
if (isset($_GET['getArticle'])){
    $articolo = getArticle($_GET['getArticle']);
} else{
    // header("Location: scrivi_tu.php");
    echo 'Articolo non trovato';
    return null;
}
?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/articolo.css">
    <title><?php echo $articolo['Titolo']?></title>
</head>
<body>
<header>
      <div>
      <button class="hamburger-menu">
        <img src="../images/hamburger-menu.png">
        <img class="logo-scuola" src="../images/logo.png">
      </button>
      <div class="logo-tutto-fila">
        <img src="../images/tutto-fila.png">
      </div>
      </div>
      <div class="links">
        <a class="link" href="index.html">
          <div>
            <img src="../images/house-icon.png">
          </div>
          <label>HOME</label>
        </a>
        <a class="link" href="archive.html">
          <div>
            <img src="../images/archive-icon.png">
          </div>
          <label>ARCHIVIO</label>
        </a>
        <a class="link" href="about.html">
          <div>
            <img src="../images/redaction-icon.png">
          </div>
          <label>REDAZIONE</label>
        </a>
        <a class="link" href="write.php">
          <div>
            <img src="../images/write-icon.png">
          </div>
          <label>SCRIVI TU</label>
        </a>
      </div>
      <div class="search-bar">
        <img src="../images/search-icon.png">
        <input type="text">
      </div>
    </header>

    <div>
        <h1><?php echo $articolo['Titolo']?></h1>
        <h2><?php echo $articolo['Sottotitolo']?></h2>
        <p>Autore: <?php echo $articolo['Autore']?></p>
    </div>

    <article>
        <p>
            <?php echo $articolo['Corpo']?>
        </p>
        <p>
            <img src="<?php echo $articolo['ImagePath']?>" alt=""> 
        </p>
    </article>

    <footer>
        <p>&copy; 2024 <?php echo $articolo['Autore']?> - Licei Le Filandiere. Tutti i diritti riservati.</p>
    </footer>
    <script src="../scripts/header.js"></script>
    <script src="../scripts/highlights.js"></script>
</body>
</html>