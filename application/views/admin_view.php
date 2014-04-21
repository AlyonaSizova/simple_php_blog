<?php
echo "<a href=\"/articles/new\"><button>new article</button></a>";
		echo "<a href=\"/admin/new\"><button>new user</button></a><br><br>";
		echo "Администраторы:<br>";
foreach ($data['admin'] as $key => $value) {
		extract($value);
		echo $username . " " . $email; 
		echo "<a href=\"/admin/delete/$id\"><button>delete</button></a><br>";
	}
?>		
