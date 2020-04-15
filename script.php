<?php

// This is to demonstrate that parent script will run this within 5-6 seconds even when running in parallel
sleep(5);

$processIndex = $argv[1];

$data = [
	'process_index' => $processIndex,
	'rand' => random_int(1, 9),
];

fwrite(STDOUT, json_encode($data));
