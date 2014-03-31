 
<h1>Страница авторизации</h1>
<p>
<form action="" method="post" name="login_form">
<table class="login">
	<div>
    	<label for="user-name">Ваше имя</label>
    	<input type="text" id="user-name" name="name"/>
  	</div>
  	<div>
    	<label for="email">Email</label>
    	<input type="mail" id="email"e name="email"/>
  	</div>
  	<div>
  		<label for="pass">Пароль</label>
  		<input type="password" id"pass" name="password">
  	</div>	
  	<div>
    	<input type="submit" value="Войти"/>
  	</div>
	<!--<tr>
		<th colspan="2">Авторизация</th>
	</tr>
	<tr>
		<td>Логин</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>маил</td>
		<td><input type="text" name="email"></td>
	</tr>
	<tr>
		<td>Пароль</td>
		<td><input type="password" name="password"></td>
	</tr>
	<th colspan="2" style="text-align: right">
	<input type="submit" value="Войти" name="btn"
	style="width: 150px; height: 30px;"></th>-->
</table>
</form>
</p>

<?php if($_SESSION['admin'] == 1) { ?>
<p style="color:green">Авторизация прошла успешно.</p>
<?php } elseif($_SESSION['admin'] = 0) { ?>
<p style="color:red">Логин и/или пароль введены неверно.</p>
<?php ;}?> 