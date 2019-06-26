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
class ListShardsRequest extends Request
{

    private $logstore;

    /**
     * ListShardsRequest Constructor
     * @param $project
     * @param $logstore
     */
    public function __construct($project, $logstore)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }

    public function setLogstore($logstore)
    {
        $this->logstore = $logstore;
    }


}
