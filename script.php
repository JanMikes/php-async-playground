<?php

// This is to demonstrate that parent script will run this within 5-6 seconds even when running in parallel
return function(\Amp\Parallel\Sync\Channel $channel) use ($argv) {
	sleep(5);

	$processIndex = $argv[1];

	$data = [
		'process_index' => $processIndex,
		'rand' => random_int(1, 9),
	];

	// Original code:
	// fwrite(STDOUT, json_encode($data));

	// Because of using channel, it takes care of serialization
	yield $channel->send($data);
};
