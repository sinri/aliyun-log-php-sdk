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
class ApplyConfigToMachineGroupRequest extends Request
{
    private $groupName;
    private $configName;

    /**
     * ApplyConfigToMachineGroupRequest Constructor
     * @param $project
     * @param null $groupName
     * @param null $configName
     */
    public function __construct($project, $groupName = null, $configName = null)
    {
        parent::__construct($project);
        $this->groupName = $groupName;
        $this->configName = $configName;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
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
