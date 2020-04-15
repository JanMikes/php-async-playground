<?php

$rand = rand(1, 9);

sleep(5);

$json = json_encode(['rand' => $rand]);

fwrite(STDOUT, $json);
