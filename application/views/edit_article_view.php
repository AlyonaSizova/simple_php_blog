  <title>Редактирование</title>
  <h1>Заполните форму.</h1>
  <p><span class="error">* Обязательно заполнить</span></p>
  <form method="post" action=""> 
  <table class = "article"> 
    <tr> 
        <td><label for="name">Название:</label></td>
        <td><input type="text" name="name" value = <?php echo $articles['title'];?>>
          <span class="error">* </span></td>
    </tr>
    <tr>
        <td><label for="text">Текст:</label></td>
        <td><textarea name="text" rows="10" cols="60"><?php echo $articles['text']; ?></textarea>
          <span class="error">* </span></td>
    </tr>
    <tr>
        <td><label for="tags">Тэги (через ","):</label></td>
        <td><input type="text" name="tags" value = "<?php echo $data['tags_to_article']; ?>"></td>

    </tr>
        <td><input type="submit" name="submit" value="Готово"></td>
  </table>    
  </form>