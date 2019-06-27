<?php


use sinri\aliyun\sls\AliyunLogClient;

require_once __DIR__ . '/../src/autoload.php';

$config = [
    'endpoint' => 'https://cn-hangzhou.log.aliyuncs.com',
    'accessKeyId' => '',
    'accessKey' => '',
    'project' => '',
    'logstore' => '',
    'token' => '',
];

// build a config file contains an array as above format and include it here
require_once __DIR__ . '/../../../debug/config.php';

$client = new AliyunLogClient($config['endpoint'], $config['accessKeyId'], $config['accessKey'], $config['token']);