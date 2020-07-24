<div class="work-zone">

<?php
if(isset($info)) { ?>
	<h1><?php echo $info; ?></h1>
<?php }

if(isset($_GET['author'])) { ?>
	<div class="prod-info"><?php
		echo '<span class="prod-parameter">Имя автора: </span>'.hc($_GET['author']).'<br><span class="prod-parameter">Об авторе: </span>'.hc($about_author).'<br><span class="prod-parameter">Книги автора: </span>';
		for($i = 0; $i < $m; $i++) {
			echo "<br><a href='/admin/books?book=$author_books[$i]'>".$author_books[$i]."</a>";
		}?>
	</div>
<?php
} else { ?>
	<form action="" method="post">
	<?php
	while($row = $books->fetch_assoc()) { ?>
		<hr><div class="prod-edit"><a href="/admin/books/edit?id=<?php echo $row['id'];?>">РЕДАКТИРОВАТЬ</a></div>
		<div class="prod-edit"><input type="checkbox" name="ids[]" value="<?php echo $row['id'];?>"> УДАЛИТЬ</div>
		<?php
		if(isset($_GET['book'])) {?>
			<div class="prod-edit"><input type="submit" name="delete" value="Подтвердить удаление"></div>
			<div class="prod-edit"><a href="/admin/books">ВЕРНУТЬСЯ К ОБЩЕМУ СПИСКУ КНИГ</a></div>
		<?php }?>
		<br><div class="prod-info"><?php echo '<span class="prod-parameter">Название: </span>'.hc($row['name']).'<br><span class="prod-parameter">Код книги: </span>'.hc($row['code']).'<br><span class="prod-parameter">Цена: </span>'.hc($row['price']);
		if(isset($_GET['book'])) {
			echo '<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description'])).'<br><span class="prod-parameter">Авторы книги: </span><br>';
			for($i = 0; $i < $n; $i++){
				echo "<a href='/admin/books?author=$authors[$i]'>".$authors[$i]."</a> ";
				}
			}?>
		<br><span class="prod-parameter">Наличие: </span><?php
		if ($row['availability'] == TRUE) {
			echo "есть в наличии";
		} else {
			echo "нет в наличии";
		}?>
		</div>
		<?php
		if(isset($_GET['book'])) {?>
			<div class="prod-img">
				<img src="<?php echo '/uploaded/300x400/'.$row['img']?>">
			</div>
		<?php } else {?>
					<div class="prod-img">
						<img src="<?php echo '/uploaded/100x100/'.$row['img']?>">
					</div>
					<br><div class="prod-podrobnee"><a href="/admin/books?book=<?php echo $row['name'];?>">подробнее...</a></div>
		<?php }
	}
	if(!isset($_GET['book'])) {?>
		<hr><br><div class="prod-edit"><input type="submit" name="delete" value="Удалить отмеченные продукты"></div>
		<?php
	}
} ?>
	</form>
</div>
