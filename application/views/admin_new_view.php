<?php 
if ($_SESSION['admin'] == 1) {?>
		<h1>Страница авторизации</h1>
		<p>
		<form action="" method="post">
		<table class="login">
		<p><span class="error">* required field.</span></p>	

		<tr>
			<th colspan="2">Registration</th>
		</tr>
		<tr>
			<td>Логин</td>
			<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			<td><span class="error">* <?php echo $error_name;?></span></td>
		</tr>
		<tr>
			<td>маил</td>
			<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			<td><span class="error">* <?php echo $error_email;?></span></td>
		</tr>
		<tr>
			<td>Пароль</td>
			<td><input type="password" name="password"></td>
			<td><span class="error">* <?php echo $error_password;?></span></td>
		</tr>
		<th colspan="2" style="text-align: right">
		<input type="submit" value="sign in" name="btn"
		style="width: 150px; height: 30px;"></th>
		</table>
		</form>
		</p>
	
<?php } else header("Location:/login");?>

