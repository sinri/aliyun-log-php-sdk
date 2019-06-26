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
class DeleteConfigRequest extends Request
{

    private $configName;

    /**
     * DeleteConfigRequest Constructor
     * @param $project
     * @param null $configName
     */
    public function __construct($project, $configName = null)
    {
        parent::__construct($project);
        $this->configName = $configName;
    }

    public function getConfigName()
    {
        return $this->configName;
    }

    public function setConfigName($configName)
    {
        $this->configName = $configName;
    }

}
