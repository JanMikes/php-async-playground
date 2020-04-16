<?php

require_once __DIR__ . '/vendor/autoload.php';

// To pass results via reference
$results = [];

// Async needs to run in a loop
\Amp\Loop::run(static function() use (&$results) {
	$promises = [];

	for($i=1 ; $i<=10 ; $i++) {
		$promises[] = \Amp\call(function() use ($i): \Generator {
			$process = new \Amp\Parallel\Context\Process(['script.php', $i]);

			yield $process->start();

			return yield $process->receive();
		});
	}

	// Loop awaits results from all promises
	$results = yield \Amp\Promise\all($promises);
});

$time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];

// There is 5 seconds sleep in script.php
// Running it 10 times and ending in < 6 seconds in total
\assert($time < 6);

// We will get data from all subprocesses in array
print_r($results);

echo "Script took ${time} seconds to run\n";
