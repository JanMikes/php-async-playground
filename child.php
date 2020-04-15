<?php

require_once __DIR__ . '/vendor/autoload.php';

use Amp\Parallel\Sync\Channel;

return function (Channel $channel): \Generator {
	$file = yield $channel->receive();

	sleep(rand(1, 5));

	yield $channel->send($file . ': 1');

	return 'Any serializable data';
};
