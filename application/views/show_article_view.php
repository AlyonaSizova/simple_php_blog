<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div class="row">
	<div class="col-md-8">
	<h1><span class="header"><?php echo $title . "<br>";?></span></h1>
	<div> <?php echo $text . "<br>";?> </div>
	<p> <?php echo $ts . "<br>";?> </p>
	</div>
	<div class="col-md-4">
	</div>
</div>

<form action="/comments/new" method="post" name="form">
<input name="id_comm" type="hidden" value=<?php echo $id; ?>>
<br>
<input style="width:400px;" name="author_comm" type="text" value="Автор*">
<br>
<textarea style="width:400px;" name="txt_comm" rows="10">Введите текст*</textarea>
<br><br><input type="submit" value="Оставить комментарий">
</form>
<br><br>
<?php
foreach ($data['comment'] as $key => $value) {
		extract($value);
		echo $author . "<br>" . $comm . "<br><br>"; 
		// echo "<a href=\"/articles/delete/$id\"><button>delete</button></a>";
		// echo "<a href=\"/articles/edit/$id\"><button>edit</button></a><br>";
	}
?>

<br><br>
<?php
foreach ($data['tags'] as $key => $value) {

		 echo "<a href=\"/articles/find/$value\"><button>$value</button></a>";
		// echo "<a href=\"/articles/edit/$id\"><button>edit</button></a><br>";
	}
?>