<div class="work-zone">
<?php
if(isset($info)) {?>
	<h1><?php echo $info;?></h1>
<?php }

if(!isset($_GET['id'])) {
	while($row2 = $res->fetch_assoc()) {?>
		<form action="" method="post">
		<label><input type="checkbox" name="cat_ids[]" value="<?php echo (int)$row2['id'];?>"><span class="prod-parameter"> <?php echo hc($row2['name']);?> </span></label>
	<?php }
		$res->close();?>
		<input type="submit" name="filter" value="ВЫБРАТЬ">
	</form>
<?php
}
	while($row = $products->fetch_assoc()) { ?>
	<form action="" method="post">
		<hr><div class="prod-edit"><a href="/admin/products/edit?id=<?php echo (int)$row['id'];?>">РЕДАКТИРОВАТЬ</a></div>
		<div class="prod-edit"><input type="checkbox" name="ids[]" value="<?php echo (int)$row['id'];?>"> УДАЛИТЬ</div>
		<?php if(isset($_GET['id'])) {?>
				<div class="prod-edit"><input type="submit" name="delete" value="Подтвердить удаление"></div>
		<?php }?>
		<br><div class="prod-info"><?php echo '<span class="prod-parameter">Категория: </span>'.hc($row['category']).'<br><span class="prod-parameter">Название: </span>'.hc($row['name']).'<br><span class="prod-parameter">Код товара: </span>'.(int)$row['code'];
			if(isset($_GET['id'])){echo '<br><span class="prod-parameter">Описание: </span><br>'.nl2br(hc($row['description']));}
			echo '<br><span class="prod-parameter">Цена: </span>'.(float)$row['price'];?>
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
				<img src="<?php echo '/uploaded/300x400/'.hc($row['img']);?>">
			</div>
		<?php } else {?>
				  <div class="prod-img">
					  <img src="<?php echo '/uploaded/100x100/'.hc($row['img']);?>">
				  </div>
				  <div class="clearfix"></div>
				  <br><div class="prod-podrobnee"><a href="/admin/products?id=<?php echo (int)$row['id'];?>">подробнее...</a></div>
		<?php }
	}?>
	<?php if(!isset($_GET['id'])) {?>
		<hr><br><div class="prod-edit"><input type="submit" name="delete" value="Удалить отмеченные продукты"></div>
	<?php }?>
	</form>
<div class="clearfix"></div>
<div class="back-to-all"><a href="/admin/products">ВЕРНУТЬСЯ К ОБЩЕМУ СПИСКУ ТОВАРОВ</a></div>
</div>
