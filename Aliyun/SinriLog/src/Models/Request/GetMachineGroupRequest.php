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
class GetMachineGroupRequest extends Request
{

    private $groupName;

    /**
     * GetMachineGroupRequest Constructor
     * @param $project
     * @param null $groupName
     */
    public function __construct($project, $groupName = null)
    {
        parent::__construct($project);
        $this->groupName = $groupName;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

}
