<?php

require_once __DIR__ . '/vendor/autoload.php';

// To pass results via reference
$results = [];

// Async needs to run in a loop
\Amp\Loop::run(static function() use (&$results) {
	$promises = [];

	for($i=1 ; $i<=10 ; $i++) {
		$promises[] = \Amp\call(function() use ($i): \Generator {
			$process = new \Amp\Process\Process(['php', 'script.php', $i]);

			yield $process->start();

			// Get data from sub-process stdout
			// I am not sure if there is other (better) way to pass data from child to parent?
			$json = yield \Amp\ByteStream\buffer($process->getStdout());

			return json_decode($json);
		});
	}

	// Run all promises at once
	$results = yield \Amp\Promise\all($promises);
});

$time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];

// There is 5 seconds sleep in script.php
// Running it 10 times and ending in < 6 seconds in total
\assert($time < 6);

// We will get data from all subprocesses in array
print_r($results);

echo "Script took ${time} seconds to run\n";
