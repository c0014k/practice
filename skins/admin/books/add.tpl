<div class="work-zone">
<?php
if(isset($info)) {
	echo $info;
}?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-delimiter">
<span class="prod-parameter">Добавить новую книгу:</span><br>
<table class="table-admin">
<tr>
	<td>Код</td>
	<td>
	<?php if(!empty($_POST['code'])) {?>
			<input size="26" type="text" name="code" value="<?php echo (int)($_POST['code']);?>">
	<?php } else {?>
			<input size="26" type="text" name="code">
	<?php }?>
	</td>
</tr>
<tr>
	<td>Наличие</td>
	<td>
	<?php if(isset($_POST['availability'])) {
	if($_POST['availability'] == true) {?>
		<label><input type="radio" name="availability" value="1" checked>есть в наличии</label>
		<label><input type="radio" name="availability" value="0">нет в наличии</label>
		<?php } else {?>
			<label><input type="radio" name="availability" value="1">есть в наличии</label>
			<label><input type="radio" name="availability" value="0" checked>нет в наличии</label>
		<?php }
	} else {?>
		<label><input type="radio" name="availability" value="1" >есть в наличии</label>
		<label><input type="radio" name="availability" value="0">нет в наличии</label>
	<?php }?>
	</td>
</tr>
<tr>
	<td>Название</td>
	<td>
	<?php if(!empty($_POST['name'])) {?>
			<input size="26" type="text" name="name" value="<?php echo hc($_POST['name']);?>">
	<?php } else { ?>
			<input size="26" type="text" name="name">
	<?php }?>
	</td>
</tr>
<tr>
	<td>О книге</td>
	<td>
	<?php if(!empty($_POST['description'])) {?>
			<textarea name="description" cols="28" rows="2"><?php echo hc($_POST['description']);?></textarea>
	<?php } else {?>
			<textarea name="description" cols="28" rows="2"></textarea>
	<?php }?>
	</td>
</tr>
<tr>
	<td>Цена</td>
	<td>
	<?php if(!empty($_POST['price'])) {?>
			<input size="26" type="text" name="price" value="<?php echo (float)($_POST['price']);?>">
	<?php } else {?>
			<input size="26" type="text" name="price">
	<?php }?>
	</td>
</tr>
</table>
</div>
<div class="form-delimiter">
<span class="table-admin">Укажите авторов книги:</span><br>
<select multiple size="10" name="authors[]">
<?php
while($row = $res->fetch_assoc()) {
	echo '<option>'.hc($row['name']).'</option>';
}
$res->close();?>
</select>
<br>Загрузить изображение книги:<br>
<input type="file" name="file" accept="image/jpeg,image/png,image/gif">
	<?php if (isset($errors['photo'])){echo '<span class="errors">'.$errors['photo'].'</span>';}?>
	<div class="button-add"><input type="submit" name="add" value="Добавить книгу"></div>
</div>
</form>
</div>