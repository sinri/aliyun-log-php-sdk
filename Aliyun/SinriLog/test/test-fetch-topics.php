<?php

use sinri\aliyun\sls\Models\Request\GetLogsRequest;

require_once __DIR__ . '/test-create-client.php';

// it is not available any more
//$response=$client->listTopics(new ListTopicsRequest($config['project'],$config['logstore'],"",100));

$query = "* | select __topic__ GROUP BY __topic__";

$getLogsResponse = $client->getLogs(
    new GetLogsRequest(
        $config['project'],
        $config['logstore'],
        time() - 3600,
        time(),
        "",
        $query,
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

//var_dump($response);
//echo "count=".$response->getCount().PHP_EOL;
//echo "next token=".$response->getNextToken().PHP_EOL;
//echo implode(",",$response->getTopics()).PHP_EOL;