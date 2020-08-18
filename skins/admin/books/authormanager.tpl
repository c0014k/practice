<div class="work-zone">
<?php
if(isset($info)) {
	echo $info;
}
if(isset($errors['author'])) {
	echo '<span class="errors">'.$errors['author'].'</span>';
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-delimiter-2">
		<span class="prod-parameter">Добавить нового автора:</span><br>
		Има автора:<br>
		<?php if(!empty($_POST['new_author'])) {?>
				<input type="text" name="new_author" value="<?php echo hc($_POST['new_author']);?>"><br>
		<?php } else {?>
				<input type="text" name="new_author"><br>
		<?php } ?>
		Про автора:<br>
		<?php if(!empty($_POST['about_auth'])) {?>
				<textarea name="about_auth" cols="28" rows="2"><?php echo hc($_POST['about_auth']);?></textarea>
		<?php } else {?>
				<textarea name="about_auth" cols="28" rows="2"></textarea>
		<?php } ?>
		<div class="button-add"><input type="submit" name="add_author" value="Добавить автора"></div>
	</div>
	<div class="clearfix"></div>
</form>

<br><span class="prod-parameter">Редактировать автора:</span><span class="cat-delete">Удалить автора</span><br>
<?php
	while($row = $authors->fetch_assoc()) {?>
		<div class="container-forms">
		<div class="authors-edit-name"><?php echo hc($row['name']);?></div>
			<form action="" method="post" class="form-1">
				<input type="text" name="new_name">
				<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>">
				<input type="submit" name="rename" value="Редактировать имя">
			</form>

			<form action="" method="post" class="form-1">
				<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>">
				<textarea name="new_descr" cols="21" rows="2"><?php if(isset($_POST['new_descr'])) {echo hc($_POST['new_descr']);} else {echo hc($row['description']);}?></textarea>
				<input type="submit" name="description" value="Редактировать описание">
			</form>
			<!--
			Книги автора:
			<form action="" method="post" class="form-1">
				<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>">
				<select multiple size="10" name="books[]">
					<?php
					while($row = $books->fetch_assoc()) {
						echo '<option>'.hc($row['name']).'</option>';
					}
					?>
				</select>
				<input type="submit" name="new_books" value="Редактировать книги">
			</form>
			-->
			<form action="" method="post" class="form-2">
				<div class="cat-delete"><input type="submit" name="delete" value="Удалить"></div>
				<input type="checkbox" name="auth_id" value="<?php echo (int)$row['id'];?>" id="qwe" class="cat-delete">
			</form>
		</div>
		<div class="clearfix"></div>
		<hr>
<?php }?>
</div>