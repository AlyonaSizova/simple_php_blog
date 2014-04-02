
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
		}?>	