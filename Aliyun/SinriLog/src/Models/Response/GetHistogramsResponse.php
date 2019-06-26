<?php

/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */


namespace sinri\aliyun\sls\Models\Response;


use sinri\aliyun\sls\Models\Histogram;

/**
 * The response of the GetHistograms API from log service.
 *
 * @author log service dev
 */
class GetHistogramsResponse extends Response
{

    /**
     * @var string histogram query status(Complete or InComplete)
     */
    private $progress;

    /**
     * @var integer logs' count that current query hits
     */
    private $count;

    /**
     * @var array Histogram array, histograms on the requested time range: [from, to)
     */
    private $histograms; // List<Histogram>

    /**
     * GetHistogramsResponse constructor
     *
     * @param array $resp
     *            GetHistogramsResponse HTTP response body
     * @param array $header
     *            GetHistogramsResponse HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->progress = $header ['x-log-progress'];
        $this->count = $header ['x-log-count'];
        $this->histograms = array();
        foreach ($resp as $data)
            $this->histograms [] = new Histogram ($data ['from'], $data ['to'], $data ['count'], $data ['progress']);
    }

    /**
     * Check if the histogram is completed
     *
     * @return bool true if this histogram is completed
     */
    public function isCompleted()
    {
        return $this->progress == 'Complete';
    }

    /**
     * Get total logs' count that current query hits
     *
     * @return integer total logs' count that current query hits
     */
    public function getTotalCount()
    {
        return $this->count;
    }

    /**
     * Get histograms on the requested time range: [from, to)
     *
     * @return array Histogram array, histograms on the requested time range
     */
    public function getHistograms()
    {
        return $this->histograms;
    }
}
