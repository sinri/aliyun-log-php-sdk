<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls;


use Exception;

/**
 * Class Aliyun_Log_LoggerFactory
 * Factory for creating logger instance, with $client, $project, $logstore, $topic configurable.
 * Will flush current logger when the factory instance was recycled.
 */
class LoggerFactory
{

    private static $loggerMap = array();

    /**
     * Get logger instance
     * @param AliyunLogClient $client valid log client
     * @param string $project which could be created in AliYun Logger Server configuration page
     * @param string $logstore which could be created in AliYun Logger Server configuration page
     * @param null $topic used to specified the log by TOPIC field
     * @return mixed return logger instance
     * @throws Exception if the input parameter is invalid, throw exception
     */
    public static function getLogger($client, $project, $logstore, $topic = null)
    {
        if ($project === null || $project == '') {
            throw new Exception('project name is blank!');
        }
        if ($logstore === null || $logstore == '') {
            throw new Exception('logstore name is blank!');
        }
        if ($topic === null) {
            $topic = '';
        }
        $loggerKey = $project . '#' . $logstore . '#' . $topic;
        if (!array_key_exists($loggerKey, static::$loggerMap)) {
            $instanceSimpleLogger = new AliyunLogSimpleLogger($client, $project, $logstore, $topic);
            static::$loggerMap[$loggerKey] = $instanceSimpleLogger;
        }
        return static::$loggerMap[$loggerKey];
    }

    /**
     * set modifier to protected for singleton pattern
     * Aliyun_Log_LoggerFactory constructor.
     */
    protected function __construct()
    {

    }

    /**
     * set clone function to private for singleton pattern
     */
    private function __clone()
    {
    }

    /**
     * flush current logger in destruct function
     */
    function __destruct()
    {
        if (static::$loggerMap != null) {
            foreach (static::$loggerMap as $innerLogger) {
                $innerLogger->logFlush();
            }
        }
    }
}
