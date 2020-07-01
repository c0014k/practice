<div class="work-zone">
<?php
if(isset($info)) { ?>
	<h1><?php echo $info; ?></h1>
<?php } ?>

<form action="" method="post">
	<input type="text" name="search">
	<input type="submit" value="Найти пользователя">
	<?php if(isset($search)) { ?>
		<div class="back-to-all-users"><a href="/admin/users">ВЕРНУТСЯ К СПИСКУ ВСЕХ ПОЛЬЗОВАТЕЛЕЙ</a></div>
	<?php } ?>
</form>
<?php
if(isset($search)) { ?>
	<form action="" method="post">
	<?php
	while($row = mysqli_fetch_assoc($search)) {
		if($row['active'] == 0) {
			$active = 'Аккаунт не активирован';
		} elseif ($row['active'] == 1) {
			$active = 'Аккаунт активирован';
		} else {
			$active = 'Аккаунт заблокирован';
		}
		if($row['access'] == 0) {
			$access = 'Пользователь';
		} elseif ($row['access'] == 5) {
			$access = 'Администратор';
		}
	?>
	<hr>
	<div class="prod-edit"><a href="/admin/users/edit?id=<?php echo $row['id'];?>">РЕДАКТИРОВАТЬ</a></div>
	<div><img src="<?php echo $row['img']?>"></div>
	<div>
		<?php echo '<span class="prod-parameter">Логин: </span>'.hc($row['login']).'<br><span class="prod-parameter">e-mail: </span>'.hc($row['email']).'<br><span class="prod-parameter">Возраст: </span>'.hc($row['age']).'<br><span class="prod-parameter">Пол: </span>'.hc($row['sex']).'<br><span class="prod-parameter">Активация: </span>'.$active.'<br><span class="prod-parameter">Доступ: </span>'.$access.'<br><span class="prod-parameter">Дата регистрации: </span><br>'.hc($row['regdate']).'<br><span class="prod-parameter">Последняя активность: </span><br>'.hc($row['lastactivitydate']).'<br><span class="prod-parameter">IP: </span>'.hc($row['ip']).'<br><span class="prod-parameter">Useragent: </span><br>'.hc($row['useragent']);?>
	</div><br>
<input type="checkbox" name="ids[]" value="<?php echo $row['id'];?>">УДАЛИТЬ
<?php }?>
<hr><br><input type="submit" name="delete" value="Удалить отмеченных пользователей">
	</form>
<?php
} elseif(isset($users)) { ?>
<form action="" method="post">
	<?php
	while($row = mysqli_fetch_assoc($users)) {
		if($row['active'] == 0) {
			$active = 'Аккаунт не активирован';
		} elseif ($row['active'] == 1) {
			$active = 'Аккаунт активирован';
		} else {
			$active = 'Аккаунт заблокирован';
		}
		if($row['access'] == 0) {
			$access = 'Пользователь';
		} elseif ($row['access'] == 5) {
			$access = 'Администратор';
		}
	?>
		<hr><div class="prod-edit"><a href="/admin/users/edit?id=<?php echo $row['id'];?>">РЕДАКТИРОВАТЬ</a></div>
		<div><img src="<?php echo '/uploaded/100x100/'.$row['img']?>"></div>
		<div>
			<?php echo '<span class="prod-parameter">Логин: </span>'.hc($row['login']).'<br><span class="prod-parameter">e-mail: </span>'.hc($row['email']).'<br><span class="prod-parameter">Возраст: </span>'.hc($row['age']).'<br><span class="prod-parameter">Пол: </span>'.hc($row['sex']).'<br><span class="prod-parameter">Активация: </span>'.$active.'<br><span class="prod-parameter">Доступ: </span>'.$access.'<br><span class="prod-parameter">Дата регистрации: </span><br>'.hc($row['regdate']).'<br><span class="prod-parameter">Последняя активность: </span><br>'.hc($row['lastactivitydate']).'<br><span class="prod-parameter">IP: </span>'.hc($row['ip']).'<br><span class="prod-parameter">Useragent: </span><br>'.hc($row['useragent']);?>
		</div><br>
		<input type="checkbox" name="ids[]" value="<?php echo $row['id'];?>">УДАЛИТЬ
	<?php } ?>
<hr><br><input type="submit" name="delete" value="Удалить отмеченных пользователей">
</form>
	<?php } else {
echo 'Нет зарегистированных пользователей';
}?>
</div>
