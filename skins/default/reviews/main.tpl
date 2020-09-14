<div class="work-zone-reviews">
<?php
if(isset($_SESSION['info'])) {
	echo '<div id="JSinfo" class="JSinfo">'.$_SESSION['info'].'</div>';
	unset ($_SESSION['info']);
}

if(isset($_SESSION['user']['login'])) {?>
	<div id="JSinfo" class="JSinfo"></div>

	<form id="myform" class="rev-form" onsubmit="return myAjax('text','OutputDiv');">
		<table>
			<tr>
				<td><textarea name="text" rows="10" cols="125" id="text"></textarea></td>
			</tr>
		</table>
		<div><input type="submit" value="Добавить комментарий"></div>
	</form>
<?php
	} else {
		echo '<div id="JSinfo" class="JSinfo">Авторизируйтесь, чтобы оставить комментарий</div>';
	}
?>

<div class="reviews">
	<div id="OutputDiv"></div>
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
				if ($_SESSION['user']['access'] == 5) {?>
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
