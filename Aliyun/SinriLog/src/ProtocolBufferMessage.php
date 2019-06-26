<?php


namespace sinri\aliyun\sls;


use Exception;

class ProtocolBufferMessage
{
    /**
     * ProtocolBufferMessage constructor.
     * @param null $fp
     * @param int $limit
     * @throws Exception
     */
    function __construct($fp = NULL, &$limit = PHP_INT_MAX)
    {
        if ($fp !== NULL) {
            if (is_string($fp)) {
                // If the input is a string, turn it into a stream and decode it
                $str = $fp;
                $fp = fopen('php://memory', 'r+b');
                fwrite($fp, $str);
                rewind($fp);
            }
            $this->read($fp, $limit);
            if (isset($str))
                fclose($fp);
        }
    }

    /**
     * I do not know what this class or this method should do, just stop the warnings
     * @param $fp
     * @param $limit
     * @throws Exception
     */
    protected function read($fp, $limit)
    {
        throw new Exception("Not yet");
    }
}