<h1><?php echo $articles['title'] ?></h1>
	<h5><?php echo $articles['ts'] . "<br>";?></h5>
	<p> <?php echo $articles['text'] . "<br>";?> </p> 

<?php if(isset($tags_to_article)){
		echo "<h5><br>Тэги к статье: </h5>";
		foreach ($tags_to_article as $key => $value) {
			echo "<a href=\"/articles/find/$value\">$value</a> ";
		} 
	}
?>
	

<form action="/comments/new" method="post" name="form">
<input name="id_comm" type="hidden" value=<?php echo $articles['id']; ?>>
<br>
<input style="width:400px;" name="author_comm" type="text" value="Автор*">
<br>
<textarea style="width:400px;" name="txt_comm" rows="10">Введите текст*</textarea>
<br><br><input type="submit" value="Оставить комментарий">
</form>
<br><br>

<?php if(isset($data['comment'])){
		foreach ($data['comment'] as $key => $value) {
			extract($value);
			if ($key%2) {?>
				<h5><?php echo $author . "<br>";?> </h5>
				<p><?php echo $comm . "<br>";?></p>
			<?php }else{ ?>
				<h5><?php echo $author . "<br>";?></h5>
				<p class="comment"><?php echo $comm . "<br>";?></p>
			<?php } 
		}
	}	
?>
