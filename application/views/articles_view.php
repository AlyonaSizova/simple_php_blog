<?php foreach ($data as $key => $value) {
			extract($value);?>
			<html>
 			<head>
  				<title>Articles</title>
			</head>
 			<body>
  				<h1><?php echo $title;?></h1>
  				<?php echo "<a href=\"/articles/delete/$id\"><button>delete</button></a>";
				echo "<a href=\"/articles/edit/$id\"><button>edit</button></a><br>"; ?>
  				<p><?php echo $text."...";?></p>
 			</body>
			</html>
			<?php echo "<a href= \"/articles/show/$id\"><button>Read more...</button></a><br>";
			
		}