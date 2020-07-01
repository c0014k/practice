<div class="work-zone">

<?php
while($row = mysqli_fetch_assoc($products)) { ?>
	<hr>
	<div class="prod-info">
		<div><?php echo '<span class="prod-parameter">Категория: </span>'.hc($row['category']).'<br><span class="prod-parameter">Название: </span>'.hc($row['name']);
			if(isset($_GET['id'])){echo '<br><span class="prod-parameter">Код товара: </span>'.hc($row['code']).'<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description']));}
			echo '<br><span class="prod-parameter">Цена: </span>'.hc($row['price']);?></div>
		<span class="prod-parameter">Наличие: </span><?php
		if ($row['availability'] == TRUE) {
			echo "есть в наличии";
		} else {
			echo "нет в наличии";
		}?>
	</div>
	<?php
	if(isset($_GET['id'])) {?>
		<div class="prod-img">
			<img src="<?php echo '/uploaded/300x400/'.$row['img']?>">
		</div>
		<br><a href="/products">Вернуться к общему списку</a>
	<?php } else {?>
			<div class="prod-img">
				<img src="<?php echo '/uploaded/100x100/'.$row['img']?>">
			</div>
			<div class="prod-podrobnee"><a href="/products?id=<?php echo $row['id'];?>">подробнее...</a></div>
	<?php }
} ?>
</div>
