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
class DeleteConfigResponse extends Response
{

    /**
     * DeleteConfigResponse constructor
     *
     * @param array $header
     *            GetLogs HTTP response header
     */
    public function __construct($header)
    {
        parent::__construct($header);
    }

}
