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
</head>
<body>
<header>
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
			<div class="login">
				<a href="/cab/auth" class="sp-login"></a>
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