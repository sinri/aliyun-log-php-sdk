<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models\Request;

use sinri\aliyun\sls\Models\ACL;

/**
 *
 *
 * @author log service dev
 */
class CreateACLRequest extends Request
{

    /**
     * @var ACL this is guessed by sinri
     */
    private $acl;

    /**
     * CreateACLRequest Constructor
     * @param $project
     * @param null $acl
     */
    public function __construct($project, $acl = null)
    {
        parent::__construct($project);
        $this->acl = $acl;
    }

    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl($acl)
    {
        $this->acl = $acl;
    }

}
