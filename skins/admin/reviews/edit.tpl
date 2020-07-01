<div class="rev-edit">
<?php
if(isset($_GET['id'])) {?>
<form action="" method="post">
	<table>
		<tr>
			<td><textarea rows="10" cols="120" name="text"><?php echo hc($row['text']);?></textarea></td>
		</tr>
	</table>
	<div><input type="submit" value="Изменить отзыв"></div>
</form>
<?php } ?>
</div>