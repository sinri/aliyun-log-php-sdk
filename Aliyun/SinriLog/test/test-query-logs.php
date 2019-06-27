<?php

use sinri\aliyun\sls\Models\Request\GetLogsRequest;

require_once __DIR__ . '/test-create-client.php';

$getLogsResponse = $client->getLogs(
    new GetLogsRequest(
        $config['project'],
        $config['logstore'],
        time() - 3600,
        time(),
        "",
        "level:INFO and aa_dingtalk_login_callback",
        10,
        0,
        true
    )
);
echo "Completed? " . json_encode($getLogsResponse->isCompleted()) . PHP_EOL;
echo "Count : " . $getLogsResponse->getCount() . PHP_EOL;
$logs = $getLogsResponse->getLogs();
foreach ($logs as $logIndex => $log) {
    echo "--- QUERY LOG " . $logIndex . PHP_EOL;
    echo "Time: " . $log->getTime() . PHP_EOL;
    echo "Source:" . $log->getSource() . PHP_EOL;
    foreach ($log->getContents() as $key => $value) {
        echo "> $key: $value" . PHP_EOL;
    }
}