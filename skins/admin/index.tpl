<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo hc(Core::$META['title']);?></title>
	<meta name="description" content="<?php echo hc(Core::$META['description']);?>">
	<meta name="keywords" content="<?php echo hc(Core::$META['keywords']);?>">
	<link href="/skins/default/css/normalize.css" rel="stylesheet">
	<link href="/skins/admin/css/admin.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="/skins/default/css/JS.css" rel="stylesheet">
	<script src = "/skins/default/js/scripts_v2.js"></script>
	<script src = "/libs/jquery-3.5.1.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
</head>
<body>
	<header class="work-zone-admin">
		<h1><a href="/admin">CMS</a></h1>
	<?php if(isset($_SESSION['user'])) {
			if($_SESSION['user']['access'] == 5) {?>
		<nav>
			<div class="menu">
				<div class="main-menu"><span class="pointer">PRODUCTS</span>
					<div class="sp-spear1"></div>
					<div class="drop-menu">
						<a href="/admin/products/add"><div class="link">ADD</div></a>
						<a href="/admin/products"><div class="link">EDIT</div></a>
						<a href="/admin/products/catmanager"><div class="link">Сategories manager</div></a>
					</div>
				</div>
				<div class="main-menu"><span class="pointer">BOOKS</span>
					<div class="sp-spear1"></div>
					<div class="drop-menu">
						<a href="/admin/books/add"><div class="link">ADD</div></a>
						<a href="/admin/books"><div class="link">EDIT</div></a>
						<a href="/admin/books/authormanager"><div class="link">Authors manager</div></a>
					</div>
				</div>

				<div><a href="/admin/users">USERS</a></div>
				<div><a href="/admin/users/doc">DOC</a></div>
				<div><a href="/admin/static/phpinfo">PHPINFO</a></div>
				<div><a href="/index.php">Homer</a></div>
			</div>
		</nav>
	<?php }
		}?>
	</header>
<?php echo $content;?>
<main>

</main>
<footer class="footer-admin">
	<div class="text-line">MY CMS ®
		<?php
		if (date('Y')==Core::$CREATED){
			echo Core::$CREATED;
		} else{
			echo Core::$CREATED.' - '.date('Y');
		}
		?>
		© All Rights Reserved.
	</div>
</footer>

</body>
</html>