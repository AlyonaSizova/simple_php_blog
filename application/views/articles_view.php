
<?php
if ($_SESSION['admin'] == 1) {
	foreach ($data as $key => $value) {
		extract($value);
		echo $title . " " . $text . "..."; 
		echo "<a href=\"/articles/show/$id\"><button>Read more...</button></a>";
		echo "<a href=\"/articles/delete/$id\"><button>delete</button></a>";
		echo "<a href=\"/articles/edit/$id\"><button>edit</button></a><br>";
	}
}	
else{
		foreach ($data as $key => $value) {
			extract($value);
			echo $title . " " . $text;
			echo "<a href=\"/articles/show/$id\"><button>Read more...</button></a><br>"; 
		}	
}		
?>