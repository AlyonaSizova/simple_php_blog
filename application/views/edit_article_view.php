<html>
<style>
.error {color: #FF0000;}
.header {color: #FF0099;}
</style>
<body>


  <h2><span class="header">Редактирование.</span></h2>
  <p><span class="error">* required field.</span></p>
  <form method="post" action=""> 
   Название: <input type="text" name="name" value = <?php echo $title?>>
  <span class="error">* </span>
  <br><br>
  Текст: <textarea name="text" rows="10" cols="100"><?php echo $text ?></textarea>
  <br><br>
  <input type="submit" name="submit" value="Готово"> 
  </form>
