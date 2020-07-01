<div class="work-zone">
	<h2>Авторизироваться</h2>
	<form action="/cab/auth" method="post">
		<table>
			<tr>
				<td>e-mail</td>
				<td><input type="text" name="email" value="<?php echo hc($_POST['email'] ?? '');?>"></td>
			</tr>
			<tr>
				<td>password</td>
				<td><input type="password" name="pass" value="<?php echo hc($_POST['pass'] ?? '');?>"></td>
				<td><label><input type="checkbox" name="rem"> Запомнить меня на сайте</label><br></td>
			</tr>
		</table>
		<div><input type="submit" value="Войти"></div>
		<?php echo $error ?? '';?>
	</form>
	<a href="/cab/registration"><h4>Зарегистрироваться</h4><a>
</div>
