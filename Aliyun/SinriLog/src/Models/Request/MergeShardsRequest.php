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
class MergeShardsRequest extends Request
{

    private $logstore;
    protected $shardId;

    /**
     * MergeShardsRequest Constructor
     * @param $project
     * @param $logstore
     * @param $shardId
     */
    public function __construct($project, $logstore, $shardId)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->shardId = $shardId;
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
}
