<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models\Request;
/**
 *
 *
 * @author log service dev
 */
class SplitShardRequest extends Request
{

    private $logstore;
    private $shardId;
    private $midHash;

    /**
     * SplitShardRequest Constructor
     * @param $project
     * @param $logstore
     * @param $shardId
     * @param $midHash
     */
    public function __construct($project, $logstore, $shardId, $midHash)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->shardId = $shardId;
        $this->midHash = $midHash;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }

    public function setLogstore($logstore)
    {
        $this->logstore = $logstore;
    }

    public function getShardId()
    {
        return $this->shardId;
    }

    public function getMidHash()
    {
        return $this->midHash;
    }

}
