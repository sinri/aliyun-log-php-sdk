<?php

use sinri\aliyun\sls\Models\Request\ListLogstoresRequest;

require_once __DIR__ . '/test-create-client.php';

$response = $client->listLogstores(new ListLogstoresRequest($config['project']));
echo "Response Count: " . $response->getCount() . PHP_EOL;
echo implode(" , ", $response->getLogstores()) . PHP_EOL;