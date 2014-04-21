<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" /> 
</head>
<body>
  <div id="container">
      <div id="header">Блог
        <ul class="hr">
          <li><a href="/login">Войти</a></li>
        </ul>
      </div>
      <div id="sidebar">
        <h2><a href="/">Главная</a></h2>
        <h2><a href="/articles">Статьи</a></h2>
        <div id="tags">
          <img src="/images/divider.png" alt="img" width = "160px"> 
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