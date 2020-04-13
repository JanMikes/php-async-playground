<?php

require_once __DIR__ . '/vendor/autoload.php';

use Amp\Loop;
use Amp\Parallel\Context;

Loop::run(function () {
	// Creates a context using Process, or if ext-parallel is installed, Parallel.
	$context = Context\create(__DIR__ . '/child.php');

	$pid = yield $context->start();

	$url = 'https://google.com';

	yield $context->send($url);

	$requestData = yield $context->receive();

	printf("Received %d bytes from %s\n", \strlen($requestData), $url);

	$returnValue = yield $context->join();

	printf("Child processes exited with '%s'\n", $returnValue);
});