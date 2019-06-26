<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models\Response;

/**
 * The response of the DeleteShard API from log service.
 *
 * @author log service dev
 */
class DeleteShardResponse extends Response
{
    /**
     * DeleteShardResponse constructor
     *
     * @param $headers
     */
    public function __construct($headers)
    {
        parent::__construct($headers);
    }
}
