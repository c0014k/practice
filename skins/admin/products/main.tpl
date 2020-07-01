<div class="work-zone">
<?php
if(isset($info)) { ?>
	<h1><?php echo $info; ?></h1>
<?php } ?>

<form action="" method="post">
	<?php
	while($row = mysqli_fetch_assoc($products)) { ?>
	<hr>
		<div class="prod-edit"><a href="/admin/products/edit?id=<?php echo $row['id'];?>">РЕДАКТИРОВАТЬ</a></div>
		<div class="prod-info"><?php echo '<span class="prod-parameter">Категория: </span>'.hc($row['category']).'<br><span class="prod-parameter">Название: </span>'.hc($row['name']).'<br><span class="prod-parameter">Код товара: </span>'.hc($row['code']);
			if(isset($_GET['id'])){echo '<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description']));}
			echo '<br><span class="prod-parameter">Цена: </span>'.hc($row['price']);?>
		<br><span class="prod-parameter">Наличие: </span><?php
		if ($row['availability'] == TRUE) {
			echo "есть в наличии";
		} else {
			echo "нет в наличии";
		}
		?>
		</div>
		<?php
		if(isset($_GET['id'])) {?>
			<div class="prod-img">
				<img src="<?php echo '/uploaded/300x400/'.$row['img']?>">
			</div>
			<br><div class="prod-podrobnee"><a href="/admin/products">Вернуться к общему списку</a></div>
		<?php } else {?>
				<div class="prod-img">
					<img src="<?php echo '/uploaded/100x100/'.$row['img']?>">
				</div>
				<br><div class="prod-podrobnee"><a href="/admin/products?id=<?php echo $row['id'];?>">подробнее...</a></div>
		<?php } ?>
		<br><input type="checkbox" name="ids[]" value="<?php echo $row['id'];?>"> УДАЛИТЬ
	<?php } ?>
	<hr><br><input type="submit" name="delete" value="Удалить отмеченные продукты">
</form>
</div>
