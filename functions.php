<?php

function testing(string $file) {
	$waiting = rand(5, 10);

	echo sprintf("starting %s and waiting %d\n", $file, $waiting);

	sleep($waiting);

	echo sprintf("ending %s\n", $file);
}