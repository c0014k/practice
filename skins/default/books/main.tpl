<div class="work-zone">

<?php
if(isset($_GET['author'])) { ?>
	<hr>
	<div class="prod-info"><?php
		echo '<span class="prod-parameter">Имя автора: </span>'.hc($_GET['author']).'<br><span class="prod-parameter">Об авторе: </span>'.hc($about_author).'<br><span class="prod-parameter">Книги автора: </span>';
		for($i = 0; $i < $numberOfBooks; $i++) { ?>
			<br><a href="/books?book=<?php echo hc($author_books[$i]);?>"><?php echo hc($author_books[$i]);?></a>
  <?php } ?>
	</div>
	<div class="clearfix"></div>
<?php
} else {
	while($row = mysqli_fetch_assoc($books)) { ?>
		<hr>
		<div class="prod-info">
		<div><?php echo '<span class="prod-parameter">Название: </span>'.hc($row['name']).'<br><span class="prod-parameter">Код книги: </span>'.(int)$row['code'].'<br><span class="prod-parameter">Цена: </span>'.(float)$row['price'];
		if(isset($_GET['book'])) {
			echo '<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description'])).'<br><span class="prod-parameter">Авторы книги: </span><br>';
			for($i = 0; $i < $numberOfAuthors; $i++) { ?>
				<a href="/books?author=<?php echo hc($authors[$i]);?>"><?php echo hc($authors[$i]);?></a>
      <?php }
		}?>
  		</div>
		<span class="prod-parameter">Наличие: </span><?php
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
  <?php } else { ?>
			<div class="prod-img">
				<a href="/books?book=<?php echo hc($row['name']);?>"><img src="<?php echo '/uploaded/100x100/'.hc($row['img']);?>"></a>
			</div>
			<div class="clearfix"></div>
			<div class="prod-podrobnee"><a href="/books?book=<?php echo hc($row['name']);?>">подробнее...</a></div>
  <?php }
	}
	if(!isset($_GET['book'])) {
		if(isset($_GET['num_page'])) {
			Pagination::showPagination('books',$_GET['num_page']);
		} else {
			Pagination::showPagination('books',1);
		}
	}
}
?>
</div>
