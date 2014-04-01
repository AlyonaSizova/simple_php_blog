<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" /> 
</head>
<body>
	<div id="container">
   		<div id="header">Blog</div>
   		<div id="sidebar">
   			<p><a href="/">Main</a></p>
    		<p><a href="/articles">Articles</a></p>
    		<p><a href="/admin">Admin</a></p>
    </div>
    <div id="content">
    	<?php include 'application/views/'.$content_view; ?>
    </div>
   <div id="footer">&copy; Alyona Sizova</div>
   </div> 
    
</body>
</html>