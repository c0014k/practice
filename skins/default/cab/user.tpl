<div class="work-zone">
<div class="form-delimiter">
<?php
if(isset($_SESSION['info'])) {
	echo $_SESSION['info'];
	unset ($_SESSION['info']);
}
?>
<form action="" method="post">
<table class="table-user">
<tr>
	<td>Логин</td>
	<td><?php echo hc($row['login']);?></td>
</tr>
<tr>
	<td>Пароль</td>
	<td><input type="password" name="pass"><?php if (isset($errors['pass'])){echo '<span class="errors">'.$errors['pass'].'</span>';} ?><td>
</tr>
<tr>
	<td>Электронная почта</td>
	<td><input type="text" name="email" value="<?php if(isset($_POST['email'])) {echo hc($_POST['email']);} else {echo hc($row['email']);}?>"><?php if (isset($errors['email'])){echo '<span class="errors">'.$errors['email'].'</span>';} ?><td>
</tr>
<tr>
	<td>Пол</td>
	<td><select name="sex">
		<option selected><?php if(isset($_POST['sex'])) {echo hc($_POST['sex']);} else {echo hc($row['sex']);}?></option>
		<?php
		$sex = array('Мужской','Женский','Третий пол','Неопределенный',);
		foreach($sex as $v) {
			echo '<option>'.$v.'</option>';
		}
		?>
	</select></td>
</tr>
<tr>
	<td>Возраст</td>
	<td><input type="text" name="age" value="<?php if(isset($_POST['age'])) {echo hc($_POST['age']);} else {echo hc($row['age']);}?>"></td>
</tr>
</table>
<input type="submit" name="edit" value="Внести изменения">
</form>
</div>
	<div class="form-delimiter-2">
		<img src="<?php echo '/uploaded/500x500/'.$row['img']?>"><br>
		<?php if (isset($errors['photo'])){echo '<span class="errors">'.$errors['photo'].'</span>';}?>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="file" accept="image/jpeg,image/png,image/gif">
			<input type="submit" name="editavatar" value="Изменить изображение">
		</form>
	</div>
<table class="table-user">
<tr>
	<td><b>Дополнительная информация</b></td>
</tr>
<tr>
	<td>Дата регистрации:</td>
	<td><?php echo hc($row['regdate'])?></td>
</tr>
<tr>
	<td>Последняя активность:</td>
	<td><?php echo hc($row['lastactivitydate'])?></td>
</tr>
</table>
</div>