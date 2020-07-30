<div class="work-zone">
<?php

if(isset($result)) {
	if(isset($_POST['num1'],$_POST['num2'],$_POST['action'])) {
		echo '<div class="result">'.$_POST['num1'].$_POST['action'].$_POST['num2'].' = '.$result.'</div>';
	} else {
		echo '<div class="result">'.$result.'</div>';
	}
}
?>
<form action="/index.php?module=calc" method="post">
	<div class="input-form">
		<div>Введите X :<input type="text" name="num1"></div>
		<div>Введите Y :<input type="text" name="num2"></div>
		<div>Выберете действие:
			<label> СЛОЖЕНИЕ <input type="radio" name="action" value="+"></label>
			<label> ВЫЧИТАНИЕ <input type="radio" name="action" value="-"></label>
			<label> УМНОЖЕНИЕ <input type="radio" name="action" value="*"></label>
			<label> ДЕЛЕНИЕ <input type="radio" name="action" value="/"></label>
		</div>
		<div><input type="submit"></div>
	</div>
</form>
</div>