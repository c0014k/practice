<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo hc(Core::$META['title']);?></title>
	<meta name="description" content="<?php echo hc(Core::$META['description']);?>">
	<meta name="keywords" content="<?php echo hc(Core::$META['keywords']);?>">
	<link href="/skins/default/css/normalize.css" rel="stylesheet">
	<link href="/skins/default/css/style.css" rel="stylesheet">
	<link href="/skins/default/css/calc.css" rel="stylesheet" type="text/css">
	<link href="/skins/default/css/reviews.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="/skins/default/css/JS.css" rel="stylesheet">
	<script src = "/skins/default/js/scripts_v2.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<header>
	<div class="modalWindow" id="modalReg">
		<div class="form">
			<div class="close" onclick="hideShow('modalReg');"><img src="/skins/default/img/close-window.png"></div>
			<form method="post" onsubmit="return AjaxCheckRegistration('login','regpassword','regemail','age');">
				<h2>Регистрация</h2>
				<div class="JSinfo" id="errorReg"></div>
				После регистрации вы не сможете изменить логин.
				<table>
					<tr>
						<td>*login</td>
						<td><input type="text" name="login" id="login"></td>
					</tr>
					<tr>
						<td>*password</td>
						<td><input type="password" name="pass" id="regpassword"></td>
					</tr>
					<tr>
						<td>*e-mail</td>
						<td><input type="text" name="email" id="regemail"></td>
					</tr>
					<tr>
						<td>age</td>
						<td><input type="text" name="age" id="age"></td>
						<td>* - обязательные для заполнения поля</td>
					</tr>
				</table>
				<div><input type="submit" value="Зарегистрироваться"></div>
			</form>
		</div>
	</div>

	<div class="modalWindow" id="modalAuth">
		<div class="form">
		<div class="close" onclick="hideShow('modalAuth');"><img src="/skins/default/img/close-window.png"></div>
			<h2>Авторизация</h2>
			<form method="post" onsubmit="return AjaxCheckAuth('authemail','authpassword');">
				<div class="JSinfo" id="errorAuth"></div>
				<table>
					<tr>
						<td>e-mail</td>
						<td><input type="text" name="email" id="authemail"></td>
					</tr>
					<tr>
						<td>password</td>
						<td><input type="password" name="pass" id="authpassword"></td>
						<td><label><input type="checkbox" name="rem"> Запомнить меня на сайте</label><br></td>
					</tr>
				</table>
				<div><input type="submit" value="Войти"></div>
			</form>
		</div>
	</div>
	<!--верхний бар---------------------------------------------------------------------------->
	<div class="top-bar-background">
		<div class="clearfix">
			<div class="container-top-bar">
				<div class="left-side">
					<div class="sp-phone"></div>
					<a href="#" class="top-bar">(123) 123-456</a>
					<div class="sp-mail"></div>
					<a href="#" class="top-bar">homer@domain.com</a>
				</div>

				<div class="right-side">
					<a href="#" class="sp-fb"></a>
					<a href="#" class="sp-twit"></a>
					<a href="#" class="sp-google"></a>
					<a href="#" class="sp-pint"></a>
				</div>
			</div>
		</div>
	</div>
	<!--меню----------------------------------------------------------------------------------->
	<nav class="container-nav">
		<div class="clearfix">
			<div class="logo">
				<a href="/"><img src="/skins/default/img/logo.png" alt="Logo Homer" width="131" height="44"></a>
			</div>
			<div class="menu">
				<a href="/calc">CALCULATOR</a>
				<a href="/game">GAME</a>
				<a href="/program">PROGRAM</a>
				<a href="/reviews">REVIEWS</a>
				<a href="/products">PRODUCTS</a>
				<a href="/books">BOOKS</a>
				<?php
				if(isset($_SESSION['user'])) { ?>
					<div class="logout">
						<a href="/cab/logout" class="sp-logout"></a>
					</div>
					<?php if ($_SESSION['user']['access'] == 5) { ?>
						<a href="/admin">ADMIN</a>
				<?php } elseif ($_SESSION['user']['access'] == 0 && $_SESSION['user']['active'] == 1) { ?>
						<a href="/cab/user"><?php echo $_SESSION['user']['login'];?></a> <?php
					}
				} ?>
			</div>
			<?php
			if (!isset($_SESSION['user'])) {
			?>
			<!--<div class="login">
				<a href="/cab/auth" class="sp-login"></a>
			</div>-->

			<div class="JS-login">
				<span onclick="hideShow('modalAuth');">LOGIN</span> |
				<span onclick="hideShow('modalReg');">SIGNUP</span>
			</div>
			<?php } ?>
		</div>
	</nav>
</header>

<?php echo $content;?>

<footer class="footer-homer">
	<div class="text-line">Homer ©
		<?php
		if (date('Y')==Core::$CREATED){
			echo Core::$CREATED;
		} else{
			echo Core::$CREATED.' - '.date('Y');
		}
		?>
		All Rights Reserved.
	</div>
</footer>
</body>
</html>