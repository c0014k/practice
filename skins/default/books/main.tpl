<div class="work-zone">

<?php
if(isset($_GET['author'])) { ?>
	<hr>
	<div class="prod-info"><?php
		echo '<span class="prod-parameter">Имя автора: </span>'.hc($_GET['author']).'<br><span class="prod-parameter">Об авторе: </span>'.hc($about_author).'<br><span class="prod-parameter">Книги автора: </span>';
		for($i = 0; $i < $m; $i++) {
			echo "<br><a href='/books?book=$author_books[$i]'>".$author_books[$i]."</a>";
		}?>
	</div>
<?php
} else {
	while($row = mysqli_fetch_assoc($books)) { ?>
		<hr>
		<div class="prod-info">
			<div><?php echo '<span class="prod-parameter">Название: </span>'.hc($row['name']).'<br><span class="prod-parameter">Код книги: </span>'.hc($row['code']).'<br><span class="prod-parameter">Цена: </span>'.hc($row['price']);
				if(isset($_GET['book'])) {
					echo '<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description'])).'<br><span class="prod-parameter">Авторы книги: </span><br>';
					for($i = 0; $i < $n; $i++){
						echo "<a href='/books?author=$authors[$i]'>".$authors[$i]."</a> ";
					}
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
		if(isset($_GET['book'])) {?>
			<div class="prod-img">
				<img src="<?php echo '/uploaded/300x400/'.$row['img']?>">
			</div>
		<?php } else {?>
				<div class="prod-img">
					<a href="/books?book=<?php echo $row['name'];?>"><img src="<?php echo '/uploaded/100x100/'.$row['img']?>"></a>
				</div>
				<div class="prod-podrobnee"><a href="/books?book=<?php echo $row['name'];?>">подробнее...</a></div>
		<?php }
	}
	if(!isset($_GET['book'])){
		if(isset($_GET['num_page'])) {
			Pagination::showPagination('books',$_GET['num_page']);
		} else {
			Pagination::showPagination('books',1);
		}
	}
}

?>

</div>
