<?php

require __DIR__ . '/vendor/autoload.php';

use Amp\Loop;
use Amp\Parallel\Worker\CallableTask;
use Amp\Parallel\Worker\DefaultPool;

// A variable to store our fetched results
$results = [];

// Event loop for parallel tasks
Loop::run(function () use (&$results) {
	$timer = Loop::repeat(200, function () {
		\printf(".");
	});
	Loop::unreference($timer);

	$pool = new DefaultPool;

	$coroutines = [];

	\Amp\Promise\all()

	$coroutines[] = Amp\call(function () use ($pool) {
		$result = yield $pool->enqueue(new CallableTask('file_get_contents', ['http://php.net']));

		\printf("\nRead from task: %d bytes\n", \strlen($result));

		return $result;
	});

	$results = yield Amp\Promise\all($coroutines);

	return yield $pool->shutdown();
});

echo "\nResult array keys:\n";
echo \var_export(\array_keys($results), true);