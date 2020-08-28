<div class="work-zone">
<?php
if(isset($info)) {
	echo $info;
}
if(isset($errors['cat'])) {
	echo '<span class="errors">'.$errors['cat'].'</span>';
}

?>
<form action="" method="post" enctype="multipart/form-data">
	<div>
		<span class="prod-parameter">Добавить новую категорию товара:</span><br>
		<input type="text" name="new_cat">
		<input type="submit" name="add_cat" value="Добавить категорию">
	</div>
</form>
	<br><span class="prod-parameter">Редактировать существующие категории товаров:</span><span class="cat-delete">Удалить категорию</span><br>
<?php
	while($row = $cats->fetch_assoc()) {?>
		<div class="container-forms">
		<div class="prod-cat"><?php echo hc($row['name']);?></div>
			<form action="" method="post" class="form-1">
				<input type="text" name="new_name">
				<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>">
				<input type="submit" name="rename" value="Переименовать">
			</form>

			<form action="" method="post" class="form-2">
				<div class="cat-delete"><input type="submit" name="delete" value="Удалить"></div>
				<input type="checkbox" name="cat_id" value="<?php echo (int)$row['id'];?>" id="qwe" class="cat-delete">
			</form>
		</div>
		<div class="clearfix"></div>
		<hr>
<?php }?>

</div>