<div class="work-zone">
<?php
if(isset($_SESSION)) {
	if ($_SESSION['server'] <= 0) {
		echo '<div class="result">ВЫ ПОБЕДИЛИ!</div><br>';
	} else {
		echo '<div class="result">ВЫ ПРОИГРАЛИ :(</div><br>';
	}
	unset($_SESSION['server']);
	unset($_SESSION['client']);
}
?>
</div>