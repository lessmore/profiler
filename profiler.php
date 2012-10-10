<?php

	class profiler {
		private $width = 600;
		private $height = 200;
		private $title;

		private $marginleft = 65;
		private $marginright = 20;
		private $margintop = 40;
		private $marginbottom = 20;

		function __construct() {
			$this->width += $this->marginleft + $this->marginright;
			$this->height += $this->margintop + $this->marginbottom;
			$this->title = 'Memory usage of '. $_SERVER['SCRIPT_NAME'];
			register_tick_function(array(&$this, 'tick'));
		}

		function tick() {
			file_put_contents('load', memory_get_usage().PHP_EOL, FILE_APPEND);
		}

		function chart() {
			unregister_tick_function(array(&$this, 'tick'));

			$load = explode(PHP_EOL, file_get_contents('load'));
			array_pop($load);

			$image = imagecreate($this->width, $this->height);

			$white = imagecolorallocate($image, 255, 255, 255);
			$black = imagecolorallocate($image, 0, 0, 0);

			imagefilledrectangle($image, 0, 0, $this->width, $this->height, $white);
			imagerectangle($image, 0, 0, $this->width - 1, $this->height - 1, $black);
			imagestring($image, 3, 15, $this->margintop, (round(max($load)/1024)).'kB', $black);
			imagestring($image, 3, 15, $this->height - $this->marginbottom - imagefontheight(3), (round(min($load)/1024)).'kB', $black);
			imagestring($image, 5, ($this->width - imagefontwidth(5) * strlen($this->title)) / 2, (-imagefontheight(5)  + $this->margintop) / 2, $this->title, $black);

			$xmax = count($load);
			if ($xmax < $this->width - $this->marginleft - $this->marginright) die('Insufficient data to draw a chart. Please lower ticks directive.');

			$ymin = min($load);
			$ymax = max($load) - $ymin;

			foreach ($load as $key => $value) {
				$x = (($this->width - $this->marginleft - $this->marginright) * $key) / $xmax;
				$y = (($this->height - $this->margintop - $this->marginbottom) * ($value - $ymin)) / $ymax;
				imageline($image, $x + $this->marginleft, $this->height - $this->marginbottom, $x + $this->marginleft, $this->height - $y - $this->marginbottom, $black);
			}

			ob_start();
			imagepng($image);
			print '<img src="data:image/png;base64,'.base64_encode(ob_get_clean()).'">';

			imagedestroy($image);
			unlink('load');
		}
	}

?>