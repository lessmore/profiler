<?php
	require('profiler.php');

	$profiler = new profiler;
	declare(ticks = 1);

	$a = array();
	for ($i = 0; $i < 200; $i++) { 
		array_push($a, null);
	}

	while (!empty($a)) {
		array_pop($a);
	}

	unset($a);
	$profiler->chart();
?>