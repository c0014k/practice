<div class="work-zone">
<form action="/index.php?module=game" method="post">
	<div>ВВЕДИТЕ ЧИСЛО от 1 до 3:<input type="text" name="x"></div>
	<div><input type="submit"></div>
</form>
<?php
if(isset($znach)) {
	echo '<div class="result">'.$znach.'</div><br>';
}
if(isset($stat)) {
	echo '<div class="result">'.$stat.'</div><br>';
}
?>
</div>
