<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models\Request;

use sinri\aliyun\sls\Models\MachineGroup;

/**
 *
 *
 * @author log service dev
 */
class CreateMachineGroupRequest extends Request
{
    /**
     * @var MachineGroup this is guessed by sinri
     */
    private $machineGroup;

    /**
     * CreateMachineGroupRequest Constructor
     * @param $project
     * @param null $machineGroup
     */
    public function __construct($project, $machineGroup = null)
    {
        parent::__construct($project);
        $this->machineGroup = $machineGroup;
    }

    public function getMachineGroup()
    {
        return $this->machineGroup;
    }

    public function setMachineGroup($machineGroup)
    {
        $this->machineGroup = $machineGroup;
    }

}
