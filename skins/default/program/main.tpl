<div class="work-zone">
<?php
if(isset($x)) {
	foreach ($x as $value) {
		if (is_dir((isset($_GET['link']) ? $_GET['link'].'/'.$value :$value))) {
			echo '<a href="/index.php?module=program&link='.(isset($_GET['link']) ? $_GET['link'].'/'.$value :$value).'"><img src = "/skins/default/img/img2/folder.png" alt="folder"></a>'.$value.'<br>';
		} else {
			echo '<img src = "/skins/default/img/img2/file.png" alt="file">'.$value.'<br>';
		}
	}
}?>
</div>
<?php
/*
foreach ($x as $value) {
	if (is_dir($dir.'/'.$value)) {
		echo '<a href="/index.php?module=program&page=program&link='.(isset($_GET['link']) ? $_GET['link'].'/'.$value :$value).'"><img src = "/img/img2/folder.png" alt="folder"></a>'.$value.'<br>';
	} else {
		echo '<img src = "/img/img2/file.png" alt="file">'.$value.'<br>';
	}
}
*/