<?php
class Pagination {
	static $pages;
	static $start;

	static function howPages($section,$limit,$numPage) {
		$res = q("
			SELECT *
			FROM `$section`
			") or exit('ОШИБКА:'.mysqli_error($link));
		$num_rows = mysqli_num_rows($res);
		$res->close();

		if(!isset($numPage)) {
			$numPage = 1;
			self::$start = $numPage * $limit - $limit;
		}
		else {
			self::$start = $numPage * $limit - $limit;
		}

		$pages = $num_rows / $limit;
		$k = $num_rows % $limit;

		if($k >= 1) {
			$pages += 1;
			self::$pages = (int)$pages;
		}
		else {
			self::$pages = (int)$pages;
		}
		return $limit;
	}

		static function showPagination($section,$numPage) {
		?><div class="paginator"><?php
			if(self::$pages <=5) {
				for($i=1; $i<=self::$pages; $i++) {
					?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo $i;?>"><?php echo $i;?></a></span><?php
				}
			} else {
				if($numPage >= (self::$pages-2)) {
					?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo 1;?>"><?php echo 1;?></a>...</span><?php
					for($i=(self::$pages-4); $i<=self::$pages; $i++) {
						?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo $i;?>"><?php echo $i;?></a></><?php
					}
				} elseif(($numPage > 3) && ($numPage < (self::$pages-2))){
					?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo 1;?>"><?php echo 1;?></a>...</><?php
					for($i=$numPage-2; $i<=$numPage+2; $i++) {
						?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo $i;?>"><?php echo $i;?></a></><?php
					}
					?><span class="paginator-page">...<a href="/<?echo $section?>?num_page=<?php echo self::$pages;?>"><?php echo self::$pages;?></a></><?php
				} elseif($numPage = 3) {
					for($i=$numPage-2; $i<=$numPage+2; $i++) {
						?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo $i;?>"><?php echo $i;?></a></><?php
					}
					?><span class="paginator-page">...<a href="/<?echo $section?>?num_page=<?php echo self::$pages;?>"><?php echo self::$pages;?></a></><?php
				} elseif($numPage = 2) {
					for($i=$numPage-1; $i<=$numPage+3; $i++) {
						?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo $i;?>"><?php echo $i;?></a></><?php
					}
					?><span class="paginator-page">...<a href="/<?echo $section?>?num_page=<?php echo self::$pages;?>"><?php echo self::$pages;?></a></><?php
				} elseif($numPage = 1) {
					for($i=$numPage; $i<=$numPage+4; $i++) {
						?><span class="paginator-page"><a href="/<?echo $section?>?num_page=<?php echo $i;?>"><?php echo $i;?></a></span><?php
					}
				}
			}
			?>
		</div>
		<?php
	}
}