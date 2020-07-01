<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();


$allowed = array('main','contacts','aboutus','game1','program1','file1','404');

if(!in_array($_GET['page'],$allowed)) {
	header("Location: /index.php?page=404");
	exit();
}


include $_GET['page'].'.php';






























// Функции пеерадресации на новую страницу
header("Location: index.php?page=game1over&action=lose");
exit();
//


//setcookie('key','value','/',time());
setcookie('name3','Stanislav',time()+3600*24*30,'/');
$_COOKIE['name3'] = 'Stanislav';

setcookie('name4','NEW_MESS',time()+3600*24*30,'/');
$_COOKIE['name4'] = 'NEW_MESS';

setcookie('name4','NEW_MESS',time()-3600,'/');

$_COOKIE['access'] = 1; // Выводим меня ADMIN

/*
1. Читать данные - МОЖНО ВЕЗДЕ!
2. Добавлять данные - В ПЕРИОД ОТПРАВКИ ЗАГОЛОВКОВ
3. Редактировать даныне - В ПЕРИОД ОТПРАВКИ ЗАГОЛОВКОВ
4. Удалять данные - В ПЕРИОД ОТПРАВКИ ЗАГОЛОВКОВ
*/
echo '<pre>';
echo 'SESSION: ';
print_r($_SESSION);
echo 'COOKIE: ';
print_r($_COOKIE);


$_SESSION['name'] = 'inpost';

echo @$_COOKIE['name2'];

if(!isset($_SESSION['client'])) {
	$_SESSION['client'] = 10;
	$_SESSION['server'] = 10;
}

$_SESSION['client'] = $_SESSION['client'] - rand(1,4);



// $_GET['page'] = (isset($_GET['page']) ? $_GET['page'] : 'main');



/*
$allowed = array('main','contacts','aboutus','game1','program1','file1');

$sex = array('man','girl');
if(isset($_GET['sex'])) {
	if(in_array($_GET['sex'],$sex)) {
		// Обработку анкеты
	} else {
		$_SERVER['REMOTE_ADDR'];
		exit();
		// запрос пытались подделать
	}
}


if(!in_array($_GET['page'],$allowed)) {
	exit('вы ввели недопустимые значения');
}


include $_GET['page'].'.php';

?>

<select name="sex">
<?php foreach($sex as $v) { ?>
  <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
<?php } ?>
</select>





/*
if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
	echo 'Всё ок!';
}

?>

<form action="" method="post">
  <input type="text" name="email">
  <input type="submit">
</form>



?> <?php
/*
$_GET['id'] = (int)$_GET['id'];

$_GET['money'] = (float)$_GET['money']; // 551515.145<?php aendwa...
echo $_GET['money']; // 551515.145


if($_GET['page'] != 'main') {
	exit();
}

if(isset($_POST['email'])) {
	if(!empty($_POST['email'])) {
		// name@domain - email
		// name.com - link
	}
}

isset : TRUE, FALSE
filter_var: TRUE : FALSE
/*
1. РАБОТАЕТ
2. БЕЗОПАСЕН
3. НЕ ИМЕЕТ ОШИБОК


include $_GET['page'].'.php';

include-inject = подключаниет левый файлы
include-inject + upload-inject (unpload-inj).

include 'lamp_on.jpg';

?>

<img src="file.jpg">
*/
