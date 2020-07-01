<div class="work-zone-reviews">
<?php
if(isset($info)) {
	echo $info;
}
if (isset($_SESSION['regok'])) {
	 echo $_SESSION['regok'];
	unset($_SESSION['regok']);
}
if (isset($_SESSION['user'])) { ?>
<form class="rev-form" action="/reviews" method="post">
	<table>
		<tr>
			<td><textarea rows="10" cols="120" name="text"></textarea></td>
		</tr>
	</table>
	<div><input type="submit" value="Добавить отзыв"></div>
</form>
<?php } else {
	echo 'Авторизируйтесь, чтобы оставить комментарий';
} ?>
<div class="reviews">
<?php
if (mysqli_num_rows($reviews)) {
while ($row = mysqli_fetch_assoc($reviews)) {
	?><div>
	<?php
	echo hc($row['name']);
	echo ', '.($row['date']);
	?><div class="rev-text"><?php echo nl2br(hc($row['text'])).'</div>';
	if (isset($_SESSION['user'])) {
		?>
		<div class="user-review">
			<input type="submit" value="Ответить" class="user-button">
			<input type="submit" value="Пожаловаться" class="user-button">
		</div>
		<?php
		if ($_SESSION['user']['access'] == 5) { ?>
		<div class="adm-review">
			<a href="/admin/reviews/edit?id=<?php echo (int)$row['id'];?>"><input type="button" value="Редактировать"></a>
			<a href="/admin/reviews?id=<?php echo (int)$row['id'];?>"><input type="button" value="Удалить"></a>
		</div>
	<?php
		}
	}?><hr></div><?php
}
} else {
		echo 'Пока нет отзывов';
	}
?>
</div>
</div>
