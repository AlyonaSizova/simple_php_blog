<!DOCTYPE html>
<html lang="ru">
<head>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Главная</title>
<!--    <style>
	body
	{background-color:#d0e4fe;}
	h1
	{color:orange;
	text-align:center;}
	p
	{font-family:"Times New Roman";
	font-size:20px;
	text-align:right;}
	h2
	{font-family:"Times New Roman";
	font-size:30px;
	text-align:center;}
	</style> -->
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Главная</a></li>
        <li><a href="/articles">Статьи</a></li>
        <?php if ($_SESSION['admin'] == 1) { ?>
        	<li class="active"><a href="/login/exit">Выйти</a></li>
        <?php ;} ?>
        <li class="dropdown">
          
          
        </li>
      </ul>
  </div>
  </div>
</nav>
    <?php include 'application/views/'.$content_view; ?>
</body>
</html>