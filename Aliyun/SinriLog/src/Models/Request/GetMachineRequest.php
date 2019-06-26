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
class GetMachineRequest extends Request
{

    private $uuid;

    /**
     * GetMachineRequest Constructor
     * @param $project
     * @param null $uuid
     */
    public function __construct($project, $uuid = null)
    {
        parent::__construct($project);
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

}
