<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" /> 
</head>
<body>
	<div id="container">
   		<div id="header">Blog
   			<ul class="hr">
   				<li><a href="/login/exit">log out</a></li>
  			</ul>
  		</div>
   		<div id="sidebar">
   			<h2><a href="/">Main</a></h2>
    		<h2><a href="/articles">Articles</a></h2>
    		<h2><a href="/admin">Admin</a></h2>
    		<div id="tags">
    			<img src="/images/divider.png" alt="альтернативный текст"  width = "160px"> 
   				<?php include 'application/views/'.$message_view;?>
    		</div>		
    </div>
    <div id="content">
    	<?php include 'application/views/'.$content_view; ?>
    </div>
   <div id="footer">&copy; Alyona Sizova</div>
   </div> 
    
</body>
</html>