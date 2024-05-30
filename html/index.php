<?php
  function ConnectDB(){

    $servername="localhost";
    $username="TuttoFilaAdmin";
    $password="tuttofila@GESTIONE"   ;
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=tuttofiladb",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn;

    } catch(PDOException $e){
        echo "Connection failed: ".$e->getMessage();
        return null;
    }
  }

  $sql = "SELECT COUNT(*) FROM articles";
  $db = ConnectDB();
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $num_articoli = $stmt->fetchAll();
  $num_articoli = $num_articoli[0][0];


  $sql = "SELECT * FROM articles";
  $db = ConnectDB();
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $articoli = $stmt->fetchAll();
  $json = json_encode($articoli);
  echo "<script>
          let articlesContent = $json;
          let numberOfArticles = $num_articoli;  
        </script>";

  $related1_index = random_int(1, $num_articoli-1);
  $related2_index = random_int(1, $num_articoli-1);
?>


<!DOCTYPE html>
<html lang="it">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="../styles/general.css">
      <link rel="stylesheet" href="../styles/header.css">
      <link rel="stylesheet" href="../styles/sidebar.css">
      <link rel="stylesheet" href="../styles/homepage.css">

      <title>Tuttofila - Homepage</title>
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
        <a class="page-link" href="index.php">
          <div>
            <img src="../images/house-icon.png">
          </div>
          <label>HOME</label>
        </a>
        <a class="page-link" href="archive.php">
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
        <a class="page-link" href="archive.php">
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

    <main class="flex-center">
      <div class="container">
        <label class="title">ARTICOLI IN EVIDENZA</label>
        <a class="see-more" href="archive.php">
          <label>Vedi tutti gli articoli</label>
          <label class="see-more-arrow"> &#8594;</label>
        </a>
        <div class="feed">
          <div class="highlights">
            <div class="article">
              <img>
              <div class="article-info">
                <label class="article-data"></label>
                <label class="article-title"></label>
                <label class="article-description"></label>
              </div>
            </div>
            <div class="scroll-tabs">
              <button class="tab-back">
                <img src="../images/arrow-icon.png">
              </button>
              <div class="tablist">
                <div class="cursor"><div></div></div>
                <button class="tab" id="0"></button>
                <button class="tab" id="1"></button>
                <button class="tab" id="2"></button>
                <button class="tab" id="3"></button>
                <button class="tab" id="4"></button>
                <button class="tab" id="5"></button>
                <button class="tab" id="6"></button>
                <button class="tab" id="7"></button>
                <button class="tab" id="8"></button>
                <button class="tab" id="9"></button>
              </div>
              <button class="tab-forward">
                <img src="../images/arrow-icon.png">
              </button>
            </div>
          </div>
          <div class="related">
            <label class="related-title">ARTICOLI RANDOM</label>
            <div class="article">
					    <?php  
                $imgUrl = $articoli[$related1_index]['articleImgUrl'];
                echo "<img src='$imgUrl'>";
              ?>
              <div class="article-info">
                <label class="article-data">
                  <?php  
                    $author = $articoli[$related1_index]['author'];
                    $uploadDate = $articoli[$related1_index]['uploadDate'];
                    echo $author.' --- '.$uploadDate
                  ?>
                </label>
                <label class="article-title">
                  <?php  
                    $title = $articoli[$related1_index]['title'];
                    echo $title;
                  ?>
                </label>
                <label class="article-description">
                  <?php  
                    $description = $articoli[$related1_index]['description'];
                    echo $description;
                  ?>
                </label>
              </div>
            </div>
            <div class="article">
              <?php  
                $imgUrl = $articoli[$related2_index]['articleImgUrl'];
                echo "<img src='$imgUrl'>";
              ?>
              <div class="article-info">
              <label class="article-data">
                  <?php  
                    $author = $articoli[$related2_index]['author'];
                    $uploadDate = $articoli[$related2_index]['uploadDate'];
                    echo $author.' --- '.$uploadDate
                  ?>
                </label>
                <label class="article-title">
                  <?php  
                    $title = $articoli[$related2_index]['title'];
                    echo $title;
                  ?>
                </label>
                <label class="article-description">
                  <?php  
                    $description = $articoli[$related1_index]['description'];
                    echo $description;
                  ?>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


    <script src="../scripts/header.js"></script>
    <script src="../scripts/highlights.js"></script>
  </body>
</html>