<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models\Request;

use sinri\aliyun\sls\Models\Config;

/**
 *
 *
 * @author log service dev
 */
class CreateConfigRequest extends Request
{

    /**
     * @var Config this is guessed by sinri
     */
    private $config;

    /**
     * CreateConfigRequest Constructor
     * @param $project
     * @param $config
     */
    public function __construct($project, $config)
    {
        parent::__construct($project);
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;

    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

}
