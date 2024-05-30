<?php
  if(@$_POST['uploadArticle']) {
    function add() {
      $a="You clicked on add fun";
      echo $a;
    }
    add();
  }
  else if (@$_POST['sub']) {
    function sub() {
      $a="You clicked on sub funn";
      echo $a;  
    }
    sub();  
  }
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST"> <!--  allows to call php function  -->

  <input class="article-title-input" type="text">
  <input class="article-author-input" type="text">
  <input class="article-date-input" type="datetime-local">
  <input class="article-content-input" type="text">
  <input class="article-thumbnailImg-input" type="url">
  <input class="article-articleImg-input" type="url">


  <input type="submit" name="uploadArticle" Value="Invia">

</form>