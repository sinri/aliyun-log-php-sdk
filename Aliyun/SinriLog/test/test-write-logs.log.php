<?php

use sinri\aliyun\sls\AliyunLogException;
use sinri\aliyun\sls\Models\LogItem;
use sinri\aliyun\sls\Models\Request\PutLogsRequest;

require_once __DIR__ . '/test-create-client.php';

try {
    $logItems = [];

    $logItem = new LogItem(time(), ["time" => date('Y-m-d H:i:s'), "level" => "INFO", "content" => "SDK TEST SAMPLE " . uniqid(date("Ymd-His"))]);
    $logItems[] = $logItem;

    $start = microtime(true);
    $response = $client->putLogs(new PutLogsRequest("octet", "octet", "sdk-test", null, $logItems));
    $end = microtime(true);

    echo "Request Id: " . $response->getRequestId() . PHP_EOL;
    echo "Spent: " . ($end - $start) . " s" . PHP_EOL;
} catch (AliyunLogException $e) {
    echo "Error: " . $e->getMessage() . " | " . $e->getRequestId() . PHP_EOL;
}