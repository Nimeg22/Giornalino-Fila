<html>
    <head>
        <link rel="stylesheet" href="../styles/write.css">
        <link rel="stylesheet" href="../styles/header.css">
        <link rel="stylesheet" href="../styles/sidebar.css">
        <link rel="stylesheet" href="../styles/main.css">
        
        <link rel="stylesheet" href="../styles/login.css">
    <style>
        body{
            display:block;
        }
        .hamburger-menu, .link {
        cursor: pointer;
        border: none;
        background-color: transparent;
        text-decoration: none;
        color: inherit;
        -webkit-tap-highlight-color: transparent;
        }
    </style>
    </head>
    <body>
        <header style="position:relative">
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
            <a class="link" href="write.php" style="background-color:aliceblue">
                <div style="height: 70%">
                <img style="height: 90%" src="../images/write-icon.png">
                </div>
                <label style="flex:1;align-items:center;color:black;display:block;height:auto;font-size:0.8em">SCRIVI TU</label>
            </a>
            </div>
            <div class="search-bar">
            <img src="../images/search-icon.png">
            <input type="text">
            </div>
        </header>
<?php
include("api.php");

if (isset($_SESSION["username"],$_SESSION["password"])){
    echo '<div class="wrap">
            <div class="dipartimento">Dipartimento di '.$_SESSION["username"].'</div>
            <a class="logout" href="api.php?logout=true">Logout
            <img class="logout-img" src="../images/logout.png"></a>
        </div>';
    loadArticles($_SESSION["username"]);
    echo '<form action="api.php?create=true" method="post" id="form" enctype="multipart/form-data" style="display: none;">
            <input type="text" name="autore" placeholder="Autore" required><br>
            <input type="text" name="titolo" placeholder="Titolo" required><br>
            <input type="text" name="sottotitolo" placeholder="Sottotitolo" required><br>
            <textarea name="corpo" rows="30" cols="50" placeholder="Scrivi il corpo dell\'articolo" required></textarea><br>
            <input type="file" name="image" accept="image/*"/>
            <button type="submit" class="submit" onclick="loading()">Invia</button>
        </form>
        <button onclick="show()" id="nuovo-articolo">Nuovo articolo +</button>
        <h3 id="response">';
    if (isset($_GET['response'])){echo $_GET['response'];}
    echo '</h3></body>
    <script>
        function show(){
            document.getElementById("form").style.display = "block";
            document.getElementById("response").style.display = "none";
            document.getElementById("nuovo-articolo").style.display = "none";
        }
    </script>
    </html>';
    return null;
} else if (isset($_POST["username"],$_POST["password"])){
    if (checkLogin($_POST["username"],$_POST["password"])){
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];

        header("Location: write.php");
        return null;
    } else{
        echo '
    <body>
        <div class="login-container">
        <form action="write.php" method="post">
            <select name="username" required>
                <option value="Lettere e Latino">Lettere e Latino</option>
                <option value="Lingue">Lingue</option>
                <option value="Matematica e Fisica">Matematica e Fisica</option>
                <option value="Storia e Filosofia">Storia e Filosofia</option>
            </select>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <div class="error">username o password errati</div>
        </div>
    </body></html>';
        return null;
    }
} else{
    echo '<div class="login-container">
    <form action="write.php" method="post">
        <select name="username" required>
            <option value="Lettere e Latino">Lettere e Latino</option>
            <option value="Lingue">Lingue</option>
            <option value="Matematica e Fisica">Matematica e Fisica</option>
            <option value="Storia e Filosofia">Storia e Filosofia</option>
        </select>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    </div>
</body></html>';
}