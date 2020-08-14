<div class="work-zone">
<div class="form-delimiter">
<?php
if(isset($errors['prod'])) {
	echo '<span class="errors">'.$errors['prod'].'</span>';
}
?>
<form action="" method="post">
<table class="table-admin">

<tr>
	<td>Категория товаров</td>
	<td><select name="category">
	<option selected><?php if(isset($_POST['category'])) {echo hc($_POST['category']);} else {echo hc($row['category']);}?></option>
	<?php
	while($row2 = $res->fetch_assoc()) {
		echo '<option>'.hc($row2['name']).'</option>';
	}
	$res->close();?>
	</select>
	</td>
</tr>
<tr>
	<td>Код товара</td>
	<td><input size="26" type="text" name="code" value="<?php if(isset($_POST['code'])) {echo (int)$_POST['code'];} else {echo (int)$row['code'];}?>"><td>
</tr>
<tr>
	<td>Наличие товара</td>
	<td><?php
	if (isset($_POST['availability'])) {
		if($_POST['availability'] == true) {?>
		<label><input type="radio" name="availability" value="1" checked>есть в наличии</label>
		<label><input type="radio" name="availability" value="0">нет в наличии</label>
		<?php } else {?>
		<label><input type="radio" name="availability" value="1">есть в наличии</label>
		<label><input type="radio" name="availability" value="0" checked>нет в наличии</label>
		<?php }
	} else {
		if ($row['availability'] == true) {?>
		<label><input type="radio" name="availability" value="1" checked>есть в наличии</label>
		<label><input type="radio" name="availability" value="0">нет в наличии</label>
		<?php } else {?>
		<label><input type="radio" name="availability" value="1">есть в наличии</label>
		<label><input type="radio" name="availability" value="0" checked>нет в наличии</label>
	<?php }
	}?></td>
</tr>
<tr>
	<td>Название товара</td>
	<td><input size="26" type="text" name="name" value="<?php if(isset($_POST['name'])) {echo hc($_POST['name']);} else {echo hc($row['name']);}?>"></td>
</tr>
<tr>
	<td>Описание товара</td>
	<td><textarea name="description" cols="42" rows="21"><?php if(isset($_POST['description'])) {echo hc($_POST['description']);} else {echo hc($row['description']);}?></textarea></td>
</tr>
<tr>
	<td>Цена</td>
	<td><input size="26" type="text" name="price" value="<?php if(isset($_POST['price'])) {echo (float)$_POST['price'];} else {echo (float)$row['price'];}?>"></td>
</tr>
</table>
<input type="submit" name="edit" value="Внести изменения">
</form>
</div>

<div class="form-delimiter-2">
	<img src="<?php echo '/uploaded/300x400/'.hc($row['img']);?>"><br>
	<?php if(isset($errors['photo'])){echo '<span class="errors">'.$errors['photo'].'</span>';}?>

<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file" accept="image/jpeg,image/png,image/gif">
	<input type="submit" name="editimg" value="Изменить изображение">
</form>

</div>
</div>
