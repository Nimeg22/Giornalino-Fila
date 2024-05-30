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

  $url = "articleUpload.txt";
  $articleFile = fopen($url, "r") or die("Unable to open file!");
  
  if (filesize($url)>0){
    ConnectDB();

    $sql = "SELECT COUNT(*) FROM articles";
    $db = ConnectDB();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $num_articoli = $stmt->fetchAll();
    $num_articoli = $num_articoli[0][0];
    $articleID = $num_articoli + 1;
    
    $content = json_decode(fread($articleFile,filesize($url)), true);

    // var_dump($content);

    $title = $content['title'];
    $author = $content['author'];
    $uploadDate = $content['uploadDate'];
    $description = $content['description'];
    $thumbnailImgUrl = $content['thumbnailImage'];
    $articleImgUrl = $content['articleImage'];

    $articleBody = array();

    for($i = 0; $i < $content['numOfParagraphs']; $i++){
      $parName = 'paragraph'.$i;
      $articleBody[$i] = rawurlencode($content[$parName]);
    }

    $labels = array(
      'intervista' => rawurlencode($content['intervista']),
      'in lingua' => rawurlencode($content['in lingua']),
      'politica studentesca' => rawurlencode($content['politica studentesca']),
      'fatti dal mondo' => rawurlencode($content['fatti dal mondo']),
      'salute e benessere' => rawurlencode($content['salute e benessere']),
      'editoriale' => rawurlencode($content['editoriale'])
    );

    $articleBody= json_encode($articleBody);
    var_dump($articleBody);
    $labels= json_encode($labels);



    $sql = "INSERT INTO articles (ID, title, author, uploadDate, description, content, thumbnailImgUrl, articleImgUrl, labels) VALUES ('$articleID', '$title', '$author', '$uploadDate', '$description', '$articleBody', '$thumbnailImgUrl', '$articleImgUrl', '$labels')";

    $db = ConnectDB();
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // $conn->close();
  fclose($articleFile);
  // $articleFile = fopen($url, "w") or die("Unable to open file!");
  // fwrite($articleFile, "");
  // fclose($articleFile);

}