
<?php echo  "По вашему запросу найдено ". $data['message'] . " результатов";?>
<br>
<?php unset($data['message']); 
	if (isset($data[0])) {?>
		<?php foreach ($data as $key => $value) {
			extract($value);?>
			<html>
 			<head>
  				<title>Articles</title>
  				<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" /> 
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
		echo "<h2>Ничего не найдено</h2>"; ?> 		
