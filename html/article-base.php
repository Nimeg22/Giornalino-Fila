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

  $articleID = $_GET["articleID"];

  $fetchedArticle = $articoli[$articleID-1]
?>

<!DOCTYPE html>
<html lang="it">
  <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="../styles/general.css">
		<link rel="stylesheet" href="../styles/header.css">
		<link rel="stylesheet" href="../styles/sidebar.css">
		<link rel="stylesheet" href="../styles/article-base.css">

		<title>Articolo</title>
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

    <main class="article-page-main">
      <div class="article-container">
        <div class="reactions"></div>
        <div class="article-info">
          <label class="article-title">
					<?php  echo $fetchedArticle["title"] ?> 						
					</label>
          <label class="article-data">
						<?php  echo "A cura di ". $fetchedArticle["author"] . ". Pubblicato in data " . $fetchedArticle["uploadDate"] ?> 
					</label>
          <label class="article-description">
					<?php  echo $fetchedArticle["description"]  ?> 
					</label>
        </div>
        <div class="article-body">
					<?php  
						$imgUrl = $fetchedArticle['articleImgUrl'];
						echo "<img src='$imgUrl'>";
						$content = rtrim($fetchedArticle['content'], "\0");
						$content = json_decode($content, true);
						$numOfPar = count($content);
						for ($i=0; $i < $numOfPar; $i++) { 
							echo '<p>'. rawurldecode($content[$i]) . "</p>";
						};
					?>
				</div>
      </div>

      

      <div class="related-articles">
        <div class="related-article">
					    <?php  
                $imgUrl = $articoli[$related1_index]['articleImgUrl'];
                echo "<img src='$imgUrl'>";
              ?>
          <div class="related-article-info">
            <label class="related-article-data">
                  <?php  
                    $author = $articoli[$related1_index]['author'];
                    $uploadDate = $articoli[$related1_index]['uploadDate'];
                    echo $author.' --- '.$uploadDate
                  ?>
            </label>
            <label class="related-article-title">
                  <?php  
                    $title = $articoli[$related1_index]['title'];
                    echo $title;
                  ?>
            </label>
            <label class="related-article-description">
              Appunto, perché? La DDI (Didattica Digitale Integrata) è stata un’ottima soluzione nei tempi più critici della pandemia da COVID-19: ha infatti permesso a studenti e alunni di proseguire le lezioni anche quando non sembrava più possibile, permettendo al sistema scolastico italiano di subire meno danni possibile
                  <?php  
                    $description = $articoli[$related1_index]['description'];
                    echo $description;
                  ?>
            </label>
          </div>
        </div>
        <div class="related-article">
					    <?php  
                $imgUrl = $articoli[$related2_index]['articleImgUrl'];
                echo "<img src='$imgUrl'>";
              ?>
          <div class="related-article-info">
            <label class="related-article-data">
                  <?php  
                    $author = $articoli[$related2_index]['author'];
                    $uploadDate = $articoli[$related2_index]['uploadDate'];
                    echo $author.' --- '.$uploadDate
                  ?>
            </label>
            <label class="related-article-title">
                  <?php  
                    $title = $articoli[$related2_index]['title'];
                    echo $title;
                  ?>
            </label>
            <label class="related-article-description">
              Appunto, perché? La DDI (Didattica Digitale Integrata) è stata un’ottima soluzione nei tempi più critici della pandemia da COVID-19: ha infatti permesso a studenti e alunni di proseguire le lezioni anche quando non sembrava più possibile, permettendo al sistema scolastico italiano di subire meno danni possibile
                  <?php  
                    $description = $articoli[$related1_index]['description'];
                    echo $description;
                  ?>
            </label>
          </div>
        </div>
      </div>
    </main>

    
    <script src="../scripts/header.js"></script>
  </body>
</html>