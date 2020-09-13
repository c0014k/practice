<div class="work-zone-reviews">

	<div id="errorJS" class="errorJS"></div>

	<form id="myform" class="rev-form" onsubmit="return myAjax('text','OutputDiv');">
		<table>
			<tr>
				<td><textarea name="text" rows="10" cols="100" id="text"></textarea></td>
			</tr>
		</table>
		<div><input type="submit" value="Добавить комментарий"></div>
	</form>

	<div class="reviews">
		<div id="OutputDiv"></div>
	</div>

</div>
