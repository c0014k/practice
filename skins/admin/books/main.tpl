<div class="work-zone">

<?php
if(isset($info)) {
	echo '<div class="errors">'.$info.'</div>';
}

if(isset($_GET['author'])) {?>
	<div class="prod-info"><?php
		echo '<span class="prod-parameter">Имя автора: </span>'.hc($_GET['author']).'<br><span class="prod-parameter">Об авторе: </span>'.hc($about_author).'<br><span class="prod-parameter">Книги автора: </span>';
		for($i = 0; $i < $numberOfBooks; $i++) {?>
			<br><a href="/admin/books?book=<?php echo hc($author_books[$i]);?>"><?php echo hc($author_books[$i]);?></a>
  <?php }?>
	</div>
<?php
} else {
	while($row = $books->fetch_assoc()) {?>
		<form action="" method="post">
		<hr><div class="prod-edit"><a href="/admin/books/edit?id=<?php echo (int)$row['id'];?>">РЕДАКТИРОВАТЬ</a></div>
		<div class="prod-edit"><input type="checkbox" name="ids[]" value="<?php echo (int)$row['id'];?>"> УДАЛИТЬ</div>
		<?php
		if(isset($_GET['book'])) {?>
			<input type="submit" name="delete" value="Подтвердить удаление">
		<?php }?>
		<br><div class="prod-info"><?php echo '<span class="prod-parameter">Название: </span>'.hc($row['name']).'<br><span class="prod-parameter">Код книги: </span>'.hc($row['code']).'<br><span class="prod-parameter">Цена: </span>'.hc($row['price']);
		if(isset($_GET['book'])) {
			echo '<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description'])).'<br><span class="prod-parameter">Авторы книги: </span>';
			for($i = 0; $i < $numberOfAuthors; $i++) { ?>
				<br><a href="/admin/books?author=<?php echo hc($authors[$i]);?>"><?php echo hc($authors[$i]);?></a>
	  <?php }
		}?>
		<br><span class="prod-parameter">Наличие: </span><?php
		if ($row['availability'] == TRUE) {
			echo "есть в наличии";
		} else {
			echo "нет в наличии";
		}?>
		</div>
		<?php
		if(isset($_GET['book'])) { ?>
			<div class="prod-img">
				<img src="<?php echo '/uploaded/300x400/'.hc($row['img']);?>">
			</div>
  <?php } else {?>
			<div class="prod-img">
				<img src="<?php echo '/uploaded/100x100/'.hc($row['img']);?>">
			</div>
			<div class="clearfix"></div>
			<br><div class="prod-podrobnee"><a href="/admin/books?book=<?php echo hc($row['name']);?>">подробнее...</a></div>
		<?php }
	}
	if(!isset($_GET['book'])) { ?>
		<hr><br><div class="prod-edit"><input type="submit" name="delete" value="Удалить отмеченные продукты"></div>
<?php } else {?>
		  <div class="clearfix"></div>
		  <div class="back-to-all"><a href="/admin/books">ВЕРНУТЬСЯ К ОБЩЕМУ СПИСКУ КНИГ</a></div>
<?php }
}?>
		</form>
</div>
