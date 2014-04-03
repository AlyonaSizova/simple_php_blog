<br>
	<?php if($data['message'] > 0) {?>
		<?php echo  "По вашему запросу найдено ". $data['message'] . " результатов";
		unset($data['message']);?>
		<?php foreach ($data['articles'] as $key => $value) {
			extract($value);?>
			<html>
 			<head>
  				<title>Articles</title>
			</head>
 			<body>
  				<h1><?php echo $title;?></h1>
  			<p><?php echo $text."...";?></p>
 			</body>
			</html>
			<?php echo "<a href= \"/articles/show/$id\"><button>Read more...</button></a><br>";
			echo "<a href=\"/articles/delete/$id\"><button>delete</button></a>";
			echo "<a href=\"/articles/edit/$id\"><button>edit</button></a><br>";
		}
	}
	else 
		echo "По вашему запросу ничего не найдено"; ?> 		
