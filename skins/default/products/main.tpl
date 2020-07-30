<div class="work-zone">
<?php
while($row2 = $res->fetch_assoc()){?>
	<span class="prod-cat"><a href="/products?cat=<?php echo $row2['id'];?>"><?php echo $row2['name'];?></a></span><?php
}?>
<div class="all-prod"><span class="prod-cat"><a href="/products">Вернуться к списку всех товаров</a></span></div>
<?php

if (!isset($_GET['cat'])) {
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
		<div class="prod-img">
			<a href="/products?cat=<?php echo $row['cat_id']?>&id=<?php echo $row['id'];?>"><img src="<?php echo '/uploaded/100x100/'.$row['img']?>"></a>
		</div>
		<div class="prod-podrobnee"><a href="/products?cat=<?php echo $row['cat_id']?>&id=<?php echo $row['id'];?>">подробнее...</a></div>
		<?php
	}
} elseif (isset($_GET['cat']) && !isset($_GET['id'])) {
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
	<div class="prod-img">
		<a href="/products?cat=<?php echo $row['cat_id']?>&id=<?php echo $row['id'];?>"><img src="<?php echo '/uploaded/100x100/'.$row['img']?>"></a>
	</div>
	<div class="prod-podrobnee"><a href="/products?cat=<?php echo $row['cat_id']?>&id=<?php echo $row['id'];?>">подробнее...</a></div>
	<?php
	}
} elseif(isset($_GET['id']) && isset($_GET['cat'])) {
	$row = mysqli_fetch_assoc($products) ?>
	<hr>
	<div class="prod-info">
		<div><?php echo '<span class="prod-parameter">Категория: </span>'.hc($row['category']).'<br><span class="prod-parameter">Название: </span>'.hc($row['name']);
		echo '<br><span class="prod-parameter">Код товара: </span>'.hc($row['code']).'<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description']));
			echo '<br><span class="prod-parameter">Цена: </span>'.hc($row['price']);?></div>
		<span class="prod-parameter">Наличие: </span><?php
		if ($row['availability'] == TRUE) {
			echo "есть в наличии";
		} else {
			echo "нет в наличии";
		}?>
	</div>
		<div class="prod-img">
			<img src="<?php echo '/uploaded/300x400/'.$row['img']?>">
		</div>
	<?php
}
if (!isset($_GET['cat'])) {
	if(isset($_GET['num_page'])) {
		Pagination::showPagination('products',$_GET['num_page']);
	} else {
		Pagination::showPagination('products',1);
	}
}
?>
</div>
