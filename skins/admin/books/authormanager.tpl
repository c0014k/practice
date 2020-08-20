<div class="work-zone">
<?php
if(isset($info)) {
	echo '<div class="errors">'.$info.'</div>';
} elseif(isset($errors['author'])) {
	echo '<div class="errors">'.$errors['author'].'</div>';
}

if(isset($_GET['id'])) {
	while($row = $author->fetch_assoc()) {?>
<div class="container-forms">
	<div class="authors-edit-name"><h1><?php echo hc($row['name']);?></h1>
		Книги автора:<br><ul>
		<?php
		if(isset($errors['book'])) {
			echo $errors['book'];
		} else {
				for($k = 0; $k < count($booksId); $k++){
					echo '<li>'.hc($booksByAuthor[$k]).'</li><br>';
			}
		}
		?>
		</ul>
	</div>
	<form action="" method="post" class="form-1">
		<input type="text" name="new_name">
		<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>"><br>
		<br><input type="submit" name="rename" value="Редактировать имя">
	</form>

	<form action="" method="post" class="form-1">
		<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>">
		<textarea name="new_descr" cols="42" rows="21"><?php if(isset($_POST['new_descr'])) {echo hc($_POST['new_descr']);} else {echo hc($row['description']);}?></textarea><br>
		<br><input type="submit" name="description" value="Редактировать описание">
	</form>

	Выбрать новые книги автора:<br>
	<form action="" method="post" class="form-1">
		<input type="hidden" name="id" value="<?php echo (int)$row['id'];?>">
		<select multiple size="10" name="books[]">
			<?php while($row2 = $books->fetch_assoc()) {
				echo '<option>'.hc($row2['name']).'</option>';
			}
			$books->close();?>
		</select><br>
		<br><input type="submit" name="new_books" value="Редактировать книги">
	</form>

	<form action="" method="post" class="form-2">
		<div class="cat-delete"><input type="submit" name="delete" value="Удалить"></div>
		<input type="checkbox" name="auth_id" value="<?php echo (int)$row['id'];?>" id="qwe" class="cat-delete">
	</form>
</div>
<div class="clearfix"></div>
<?php
	}
} else {?>
	<div class="form-delimiter-2">
		<form action="" method="post" enctype="multipart/form-data">
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
		</form>
	</div>

	<div class="choose_author">
		<span class="prod-parameter">Выберете автора для редактирования:</span><br>
		<?php
		while($row = $authors->fetch_assoc()) {?>
			<div class="prod-edit"><a href="/admin/books/authormanager?id=<?php echo (int)$row['id'];?>"><?php echo hc($row['name']);?></a></div><hr>
		<?php }
		$authors->close();
		?>
	</div>
<?php }?>
</div>