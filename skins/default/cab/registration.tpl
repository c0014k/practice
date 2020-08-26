<div class="work-zone">
<?php
if (isset($_SESSION['regok'])){
	echo '<h1>'.$_SESSION['regok'].'</h1>';
	unset($_SESSION['regok']);
} else { ?>
	<div class="modalWindow" id="modalAuth">
		<div class="form">
			<div class="close" onclick="Hide('modalAuth');"><b>X</b></div>

			<form action="/cab/registration" method="post">
				<h2>Регистрация</h2>
				После регистрации вы не сможете изменить логин.
				<table>
					<tr>
						<td>*login</td>
						<td><input type="text" name="login"></td>
					</tr>
					<tr>
						<td>*password</td>
						<td><input type="password" name="pass"></td>
					</tr>
					<tr>
						<td>*e-mail</td>
						<td><input type="text" name="email"></td>
					</tr>
					<tr>
						<td>age</td>
						<td><input type="text" name="age"></td>
						<td>* - обязательные для заполнения поля</td>
					</tr>
				</table>
				<div><input type="submit" value="Зарегистрироваться"></div>
			</form>
			<a href="/cab/auth"><h4>Авторизироваться</h4><a>

		</div>
	</div>
<!--
<form action="/cab/registration" method="post">
	<h2>Регистрация</h2>
	После регистрации вы не сможете изменить логин.
	<table>
		<tr>
			<td>*login</td>
			<td><input type="text" name="login" value="<?php/* echo hc($_POST['login'] ?? '');?>"></td>
			<td><?php echo $errors['login'] ?? ''; ?></td>
		</tr>
		<tr>
			<td>*password</td>
			<td><input type="password" name="pass" value="<?php echo hc($_POST['pass'] ?? '');?>"></td>
			<td><?php echo $errors['pass'] ?? ''; ?></td>
		</tr>
		<tr>
			<td>*e-mail</td>
			<td><input type="text" name="email" value="<?php echo hc($_POST['email'] ?? '');?>"></td>
			<td><?php echo $errors['email'] ?? ''; ?></td>
		</tr>
		<tr>
			<td>age</td>
			<td><input type="text" name="age" value="<?php echo hc($_POST['age'] ?? '');*/?>"></td>
			<td>* - обязательные для заполнения поля</td>
		</tr>
	</table>
	<div><input type="submit" value="Зарегистрироваться"></div>
</form>
	<a href="/cab/auth"><h4>Авторизироваться</h4><a>
-->
<?php } ?>
</div>
