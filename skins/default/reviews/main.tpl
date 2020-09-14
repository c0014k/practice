<div class="work-zone-reviews">
<?php if(isset($_SESSION['user']['login'])) {?>
	<div id="errorJS" class="errorJS"></div>

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
		echo '<div id="errorJS" class="errorJS">Авторизируйтесь, чтобы оставить комментарий</div>';
	}
?>

	<div class="reviews">
		<div id="OutputDiv"></div>
	</div>

</div>
