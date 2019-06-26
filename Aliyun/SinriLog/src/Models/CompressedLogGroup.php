<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

namespace sinri\aliyun\sls\Models;


/**
 * CompressedLogGroup is compressed LogGroup,
 * LogGroup information please refer to LogGroup
 *
 * @author log service dev
 */
class CompressedLogGroup
{

    /**
     * @var integer uncompressed LogGroup size
     *
     */
    protected $uncompressedSize;

    /**
     * @var integer uncompressed LogGroup size
     *
     */
    protected $compressedData;
    /**
     * @var int|null
     */
    protected $time;
    /**
     * @var array
     */
    protected $contents;


    public function __construct($time = null, $contents = null)
    {
        if (!$time)
            $time = time();
        $this->time = $time;
        if ($contents)
            $this->contents = $contents;
        else
            $this->contents = array();
    }

}
