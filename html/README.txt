Ho lavorato sulla pagina degli articoli, che qui trovate in formato php. 
La pagina genera tante tab quante sono necessarie per gli articoli, quindi potete testarla cambiando il numero di articoli da archive.php
Sono riuscito a mettere in comunicazione php e js, però adesso avrei bisogno di reperire i dati dal database e di capire come far funzionare tutto questo sulla pagina generata da Github pages. Qui sotto vi metto esattamente cosa va inserito nel breve codice che ho creato.

<?php
  $num_articoli = 80;  

  $articoli = array();

  for($i = 0; $i < $num_articoli; $i++ ){
    $articoli[$i] = array(
      "id" => "id_articolo", 
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

La variabile $num_articoli indica quanti saranno gli articoli e lo comunica a javascript, permettendo di creare il numero giusto di tab. Il numero andrà calcolato contando quanti sono gli articoli nel database

$articoli è un array contenitore, che terrà dentro i singoli articoli e che passo nella sua interezza a js. Con un ciclo for aggiungo gli articoli (anche quelli sono un array), che ha queste informazioni:

id: il codice univoco che attribuiremo a ciascun articolo e che permetterà di creare un url per aprirlo. Lascio a voi la modalità di creazione di questi codici, non sapendo se il database già li attribuisce in automatico. 

author: autore del titolo, che dovrà essere pescato dal database

date: il tempo trascorso dalla pubblicazione. Per ogni articolo bisognerà recuperare la data di pubblicazione e sottrarla alla data del giorno, che va ripescata ogni volta che si carica la pagina. Poi bisogna formattare la resa in base a quanto tempo è passato: se è meno di un giorno bisognerà mettere le ore (1h, 3h, 7h, ecc..), se sono giorni i giorni (3d, 10d), se sono mesi i mesi e se sono anni gli anni. Pensate anche voi se è meglio usare le diciture inglesi (h per le ore, d per i giorni...) o quelle italiane (o, gg, ms, a) 

title e imgSrc: url immagine e titolo articolo, sempre nel database


