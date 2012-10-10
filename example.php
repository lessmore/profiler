<?php
	require('profiler.php');

	$profiler = new profiler;
	declare(ticks = 30000);

	$a = array();
	for ($i=0; $i < 100000; $i++) { 
		switch (rand(0, 1)) {
			case 0:
				for ($j=0; $j < rand(0, 10000); $j++) { 
					$a[] = $i;
				}
				break;
			
			case 1:
				$d = rand(0, count($a));
				for ($j=0; $j < $d; $j++) { 
				 	if (count($a) == 0) break;
				 	array_pop($a);
				 } 
				break;
		}
	}

	unset($a);
	$profiler->chart();
?>