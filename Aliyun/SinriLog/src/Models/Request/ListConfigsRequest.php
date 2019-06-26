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
class ListConfigsRequest extends Request
{

    private $configName;
    private $offset;
    private $size;

    /**
     * ListConfigsRequest Constructor
     * @param $project
     * @param null $configName
     * @param null $offset
     * @param null $size
     */
    public function __construct($project, $configName = null, $offset = null, $size = null)
    {
        parent::__construct($project);
        $this->configName = $configName;
        $this->offset = $offset;
        $this->size = $size;
    }

    public function getConfigName()
    {
        return $this->configName;
    }

    public function setConfigName($configName)
    {
        $this->configName = $configName;
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
