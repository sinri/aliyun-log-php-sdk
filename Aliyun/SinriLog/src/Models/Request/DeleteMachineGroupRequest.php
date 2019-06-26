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
class DeleteMachineGroupRequest extends Request
{


    private $groupName;

    /**
     * DeleteMachineGroupRequest Constructor
     * @param $project
     * @param $groupName
     */
    public function __construct($project, $groupName)
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
