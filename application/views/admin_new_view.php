		<title>Регистрация</title>
		<h1>Регистрация</h1>
		<form action="" method="post">
		<table class="login">
		<span class="error">* Обязательно заполнить</span>
		<tr>
			<td>Логин</td>
			<td><input type="text" name="name" value="<?php echo $admin['name'];?>"></td>
			<td><span class="error">* <?php echo $admin['error_name'];?></span></td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td><input type="text" name="email" value="<?php echo $admin['email'];?>"></td>
			<td><span class="error">* <?php echo $admin['error_email'];?></span></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password"></td>
			<td><span class="error">* <?php echo $admin['error_password'];?></span></td>
		</tr>
		<th colspan="2" style="text-align: right">
		<input type="submit" value="sign in" name="btn"
		style="width: 150px; height: 30px;"></th>
		</table>
		</form>
		


