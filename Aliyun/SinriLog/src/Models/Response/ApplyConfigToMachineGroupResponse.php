<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models\Response;

/**
 * The response of the GetLog API from log service.
 *
 * @author log service dev
 */
class ApplyConfigToMachineGroupResponse extends Response
{

    /**
     * ApplyConfigToMachineGroupResponse constructor
     *
     * @param array $header GetLogs HTTP response header
     */
    public function __construct($header)
    {
        parent::__construct($header);
    }


}
