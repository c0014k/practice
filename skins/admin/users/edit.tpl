<div class="work-zone">
<div class="form-delimiter">
<form action="" method="post">
<table class="table-admin">
<tr>
	<td>Логин</td>
	<td><input type="text" name="login" value="<?php if(isset($_POST['login'])) {echo hc($_POST['login']);} else {echo hc($row['login']);}?>"><?php if (isset($errors['login'])){echo '<span class="errors">'.$errors['login'].'</span>';}?></td>
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
<tr>
	<td>Активация учетной записи</td>
	<td><input type="text" name="active" value="<?php if(isset($_POST['active'])) {echo hc($_POST['active']);} else {echo hc($row['active']);}?>"></td>
</tr>
<tr>
	<td>Уровень доступа</td>
	<td><input type="text" name="access" value="<?php if(isset($_POST['access'])) {echo hc($_POST['access']);} else {echo hc($row['access']);}?>"></td>
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
<table class="table-admin">
<tr>
	<td><b>Дополнительная информация</b></td>
</tr>
<tr>
<td>Дата регистрации:</td>
	<td><?php echo	 hc($row['regdate'])?></td>
</tr>
<tr>
	<td>Последняя активность:</td>
	<td><?php echo 	hc($row['lastactivitydate'])?></td>
</tr>
<tr>
	<td>IP адрес:</td>
	<td><?php echo 	hc($row['ip']);?></td>
</tr>
<tr>
	<td>Info:</td>
	<td><?php echo 	hc($row['useragent']);?></td>
</tr>
</table>
</div>