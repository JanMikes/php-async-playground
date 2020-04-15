<?php

require_once __DIR__ . '/vendor/autoload.php';

$results = [];

\Amp\Loop::run(function() use (&$results) {
	$callback = function(\Amp\Process\Process $process) use (&$results): \Generator {
		yield $process->start();

		$json = yield \Amp\ByteStream\buffer($process->getStdout());

		return json_decode($json);
	};

	$promises = [];
	for($i=1 ; $i<=10 ; $i++) {
		$process = new \Amp\Process\Process(['php', 'script.php']);
		$promises[] = new \Amp\Coroutine($callback($process));
	}

	$results = yield \Amp\Promise\all($promises);
});

print_r($results);
