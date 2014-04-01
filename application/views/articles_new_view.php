
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

 </head> 

<?php if($title == "" && $text == "") { ?>
  <h2><span class="header">Заполните форму.</span></h2>
  <p><span class="error">* required field.</span></p>
  <form method="post" action=""> 
   Название: <input type="text" name="name">
  <span class="error">* </span>
  <br><br>
  Текст: <textarea name="text" rows="10" cols="100">"bitch"</textarea>
  <br><br>
  Тэги(через ","): <input type="text" name="tags">
  <br><br>
  <input type="submit" name="submit" value="Готово"> 
  </form>
<?php } elseif($title != "") { ?>
  <h2><span class="header"><?php echo $title . "<br>";?></span></h2>
  <p> <?php echo $text . "<br>";?> </p>
  <p> <?php echo $id . "<br>";?> </p>
  <?php } ?>




<?php
$req_path=$_SERVER['REQUEST_URI'];
echo "Http req path: " . $req_path . "<br>";
echo "Http req method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
?>

</html>