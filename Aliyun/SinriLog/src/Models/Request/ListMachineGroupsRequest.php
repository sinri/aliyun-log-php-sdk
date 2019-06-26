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
class ListMachineGroupsRequest extends Request
{

    private $groupName;
    private $offset;
    private $size;

    /**
     * ListMachineGroupsRequest Constructor
     * @param $project
     * @param null $groupName
     * @param null $offset
     * @param null $size
     */
    public function __construct($project, $groupName = null, $offset = null, $size = null)
    {
        parent::__construct($project);
        $this->groupName = $groupName;
        $this->offset = $offset;
        $this->size = $size;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }
}
