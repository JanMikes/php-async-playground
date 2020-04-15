<?php

require_once __DIR__ . '/vendor/autoload.php';

use Amp\Process\Process;

\Amp\Loop::run(function() {
	$process = new Process(['php', 'script.php']);

	yield $process->start();

	echo yield \Amp\ByteStream\buffer($process->getStdout());

	$code = yield $process->join();
	echo "Process exited with {$code}.\n";
});
