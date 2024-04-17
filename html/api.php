<?php
session_start();

function ConnectDB(){
    $servername="localhost";
    $username="root";
    $password="";
    
    try{
        $conn = new PDO("mysql:host=$servername;dbname=giornalino",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn;

    } catch(PDOException $e){
        echo "Connection failed: ".$e->getMessage();
        return null;
    }
}

function checkLogin($username,$password){
    $password = hash("sha256",$password);
    $sql = "SELECT Username,Password from dipartimenti WHERE Username=? AND Password=?";
    $db = ConnectDB();
    $stmt = $db->prepare($sql);
    $stmt->execute([$username,$password]);
    $data = $stmt->fetchAll();
    if($stmt->rowCount()>0){
        return true;
    } else{
        return false;
    }
}

function creaArticolo($dipartimento,$autore, $titolo, $sottotitolo, $corpo){
    $file_extension = explode(".", $_FILES["image"]["name"]);
    $name = "../uploaded-images/" . uniqid() . "." . end($file_extension);
    move_uploaded_file($_FILES["image"]["tmp_name"], $name);
    $sql = "INSERT INTO articoli(Dipartimento, Autore, Titolo, Sottotitolo, Corpo, ImagePath) VALUES (?,?,?,?,?,?)";
    $db = ConnectDB();
    $stmt = $db->prepare($sql);
    $stmt->execute([$dipartimento,$autore, $titolo, $sottotitolo, $corpo, $name]);
    return true;
}

function loadArticles($dipartimento){
    $sql = "SELECT IdArticolo,Autore,Titolo,Sottotitolo FROM articoli WHERE Dipartimento=?";
    $db = ConnectDB();
    $stmt = $db->prepare($sql);
    $stmt->execute([$dipartimento]);
    $data = $stmt->fetchAll();
    if($stmt->rowCount()>0){
        echo "<table id='table'><thead><tr>";
        echo "<th>Autore</th><th>Titolo</th><th>Sottotitolo</th>";
        echo "</tr></thead><tbody>";
        foreach($data as $row){
            echo "<tr>";
            echo "<td class='td-start'><a href='articolo.php?getArticle=". $row['IdArticolo'] ."' class='td-a-href'> ".$row['Autore']."</a></td>";
            echo "<td><a href='articolo.php?getArticle=". $row['IdArticolo'] ."' class='td-a-href'> ".$row['Titolo']."</a></td>";
            echo "<td class='td-end'><a href='articolo.php?getArticle=". $row['IdArticolo'] ."' class='td-a-href'> ".$row['Sottotitolo']."</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else{
            echo "Non hai ancora pubblicato nessun articolo";
        }
}

function getArticle($idArticolo){
    $sql = "SELECT Autore,Titolo,Sottotitolo,Corpo,ImagePath FROM articoli WHERE IdArticolo=?";
    $db = ConnectDB();
    $stmt = $db->prepare($sql);
    $stmt->execute([$idArticolo]);
    $data = $stmt->fetchAll();
    if($stmt->rowCount()>0){
        return $data[0];
    }
}

if (isset($_SESSION["username"],$_SESSION["password"])){
    // crea articolo
    if (isset($_GET['create'],$_POST['autore'],$_POST['titolo'],$_POST['sottotitolo'],$_POST['corpo'],$_FILES["image"]) && $_GET['create']){
        $mailMessage = '
        <html>
            <head>
                <style>
                body {
                    font-family: "Arial", sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    color: #333;
                }
                
                header {
                    background-color: #797979;
                    color: #fff;
                    padding: 20px;
                    text-align: center;
                }
                
                article {
                    max-width: 800px;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: #fff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                
                footer {
                    background-color: #797979;
                    color: #fff;
                    text-align: center;
                    padding: 10px;
                    bottom: 0;
                }
                
                h1, h2 {
                    color: #ffffff;
                }
                
                p {
                    line-height: 1.6;
                }
                </style>
            </head>
            <body>
                <header>
                    <h1>'.  $_POST['titolo'].'</h1>
                    <h2>'.  $_POST['sottotitolo'].'</h2>
                    <p>Autore: '.  $_POST['autore'].'</p>
                </header>
            
                <article>
                    <p>
                        '. $_POST['corpo'].'
                    </p>
                    <p>
                        <img src="'.$_FILES['image']['name'].'">
                </article>
            
                <footer>
                    <p>&copy; 2024 '.  $_POST['autore'].' - Licei Le Filandiere. Tutti i diritti riservati.</p>
                </footer>
            </body>
        </html>';
        $header = array("From" => "superclescionediclash@gmail.com", "MIME-Version" => "1.0", "Content-Type" => "text/html; charset=iso-8859-1");
        $mailObject = $_POST['autore']." (".$_SESSION["username"].") ha pubblicato un nuovo articolo";
        if (creaArticolo($_SESSION["username"],$_POST['autore'],$_POST['titolo'],$_POST['sottotitolo'],$_POST['corpo']) && mail("ale210.yt@gmail.com",$mailObject,$mailMessage,$header)){
            header("Location: write.php?response=Articolo inviato con successo");
            return "success";
        } else{
            header("Location: write.php?response=Errore, articolo non creato");
            return "fail";
        }
    }

    // logout
    if(isset($_GET['logout']) && $_GET['logout']){
        $_SESSION = array();
        header("Location: write.php");
        return null;
    }
}
// $mailMessage = "<html style='text-align:center'>".$_POST['titolo']."<br><br>".$_POST['sottotitolo']."<br><br>".$_POST['corpo']."</html>";
// $boundary = "==String_Boundary_x" .md5(time()). "x";
// $message = "Se visualizzi questo testo il tuo programma non supporta i MIME\r\n--".$boundary."Content-Type: text/plain charset='iso-8859-1'\r\nContent-Transfer-Encoding: 7bit\r\n".$mailMessage."\r\n--".$boundary."Content-Type: text/html charset='iso-8859-1'\r\nContent-Transfer-Encoding: 7bit\r\n".$mailMessage."--".$boundary."--";
// $header = "From: superclescionediclash@gmail.com\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative\r\nboundary=$boundary";
?>