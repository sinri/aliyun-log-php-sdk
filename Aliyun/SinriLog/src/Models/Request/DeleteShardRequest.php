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
class DeleteShardRequest extends Request
{

    private $logstore;
    private $shardId;

    /**
     * DeleteShardRequest Constructor
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
