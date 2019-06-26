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
class DeleteACLRequest extends Request
{

    private $aclId;

    /**
     * DeleteACLRequest Constructor
     * @param $project
     * @param null $aclId
     */
    public function __construct($project, $aclId = null)
    {
        parent::__construct($project);
        $this->aclId = $aclId;
    }

    public function getAclId()
    {
        return $this->aclId;
    }

    public function setAclId($aclId)
    {
        $this->aclId = $aclId;
    }

}
