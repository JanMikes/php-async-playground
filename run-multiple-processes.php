<?php

require_once __DIR__ . '/vendor/autoload.php';

$results = [];

\Amp\Loop::run(function() use (&$results) {
	$promises = [];

	for($i=1 ; $i<=10 ; $i++) {
		$process = new \Amp\Process\Process(['php', 'script.php']);

		$promises[] = \Amp\call(function() use ($process): \Generator {
			yield $process->start();

			$json = yield \Amp\ByteStream\buffer($process->getStdout());

			return json_decode($json);
		});
	}

	$results = yield \Amp\Promise\all($promises);
});

$time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];

echo "Script took ${time} seconds to run\n";

// print_r($results);
