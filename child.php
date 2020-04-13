<?php

require_once __DIR__ . '/vendor/autoload.php';

use Amp\Parallel\Sync\Channel;

return function (Channel $channel): \Generator {
	$url = yield $channel->receive();

	$data = file_get_contents($url); // Example blocking function

	yield $channel->send($data);

	return 'Any serializable data';
};