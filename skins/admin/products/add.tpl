<div class="work-zone">
<?php
if(isset($info)) {
	echo $info;
} ?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-delimiter-2">
	<span class="prod-parameter">Добавить новую категорию товара:</span><br>
	<input type="text" name="new_cat">
	<input type="submit" name="add_cat" value="Добавить категорию">
	</div>
</form>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-delimiter-2">
<span class="prod-parameter">Добавить новый товар:</span><br>
<table class="table-admin">
<tr>
	<td>Категория товаров</td>
	<td>
	<select name="category">
	<?php if(isset($_POST['category'])) {?>
		<option selected><?php echo hc($_POST['category']);
			while($row = $res->fetch_assoc()){
				echo '<option>'.$row['name'].'</option>';
			}?></option>
		<?php } else {?>
		<option selected>Выберете категорию товаров</option>
		<?php
		while($row = $res->fetch_assoc()){
			echo '<option>'.$row['name'].'</option>';
		}
	}
	$res->close();?>
	</select>
	</td>
</tr>
<tr>
	<td>Код товара</td>
	<td>
	<?php if(!empty($_POST['code'])) {
		$code = hc($_POST['code']);?>
		<input size="26" type="text" name="code" value="<?php echo $code?>">
	<?php } else {?>
		<input size="26" type="text" name="code">
	<?php } ?>
	</td>
</tr>
<tr>
	<td>Наличие товара</td>
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
	<td>Название товара</td>
	<td>
	<?php if(!empty($_POST['name'])) {
		$name = hc($_POST['name']);?>
		<input size="26" type="text" name="name" value="<?php echo $name?>">
	<?php } else {?>
		<input size="26" type="text" name="name">
	<?php } ?>
	</td>
</tr>
<tr>
	<td>Описание товара</td>
	<td>
	<?php if(!empty($_POST['description'])) {
		$description = hc($_POST['description']);?>
		<textarea name="description" cols="28" rows="2"><?php echo $description?></textarea>
	<?php } else {?>
		<textarea name="description" cols="28" rows="2"></textarea>
	<?php } ?>
	</td>
</tr>
<tr>
	<td>Цена товара</td>
	<td>
	<?php if(!empty($_POST['price'])) {
		$price = hc($_POST['price']);?>
		<input size="26" type="text" name="price" value="<?php echo $price?>">
	<?php } else {?>
		<input size="26" type="text" name="price">
	<?php } ?>
	</td>
</tr>
</table>
<br>Загрузить изображение книги:<br>
<input type="file" name="file" accept="image/jpeg,image/png,image/gif">
<?php if (isset($errors['photo'])){echo '<span class="errors">'.$errors['photo'].'</span>';} ?>
<input type="submit" name="add" value="Добавить товар">
</div>
</form>
</div>