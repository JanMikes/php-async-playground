<?php

require_once __DIR__ . '/vendor/autoload.php';

use Amp\Parallel\Worker;
use Amp\Promise;

$files = [
	'a',
	'b',
	'c',
	'd',
];

$promises = [];
foreach ($files as $file) {
	$promises[$file] = Worker\enqueueCallable('testing', $file);
}

$responses = Promise\wait(Promise\all($promises));

foreach ($responses as $file => $response) {
	\printf("Read %d bytes from %s\n", \strlen($response), $file);
}