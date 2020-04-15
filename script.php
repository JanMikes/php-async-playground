<?php

$rand = rand(1, 9);
fwrite(STDOUT, 'Start rand: ' . $rand . "\n");
sleep(2);
fwrite(STDOUT, 'End rand: ' . $rand . "\n");
