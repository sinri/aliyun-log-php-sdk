<?php


namespace sinri\aliyun\sls\Models\Response;

/**
 * Class GetContextLogsDIYResponse
 * @package sinri\aliyun\sls\Models\Response
 * @since 1.0.3
 */
class GetContextLogsDIYResponse extends Response
{
    /**
     * total_lines
     * 返回的总日志条数，包含请求参数中所指定的起始日志。
     * @var int
     */
    protected $totalLines;
    /**
     * back_lines
     * 向前查询到的日志条数。
     * @var int
     */
    protected $backLines;
    /**
     * forward_lines
     * @var int
     */
    protected $forwardLines;
    /**
     * 表示查询的结果是否完整，Complete表示完整，其他值为不完整。
     * @var string
     */
    protected $progress;
    /**
     * 获取到的日志，按上下文顺序排列。当根据指定的日志查询不到上下文日志时，此参数为空。
     * logs 中的每一项都是该日志的内容（键值对），除用户日志内容外，还包含如下三个字段。
     * * __index_number__ string 该日志在本次查询结果中相对上下文的位置，负数表示上文，0表示起始日志，正数表示下文。例如：-100表示起始日志往前的第100条日志。
     * * __tag__:__pack_id__ string 该日志所属的Log Group的唯一标识，可作为请求参数中的pack_id进行查询。
     * * __pack_meta__ string 该日志在所属Log Group内的唯一标识，可作为请求参数中的pack_meta进行查询。
     * @var array
     */
    protected $logs;

    public function __construct($resp, $headers)
    {
        parent::__construct($headers);
        $this->backLines = $resp['back_lines'];
        $this->forwardLines = $resp['forward_lines'];
        $this->logs = $resp['logs'];
        $this->progress = $resp['progress'];
        $this->totalLines = $resp['total_lines'];
    }

    /**
     * @return int
     */
    public function getTotalLines()
    {
        return $this->totalLines;
    }

    /**
     * @return int
     */
    public function getBackLines()
    {
        return $this->backLines;
    }

    /**
     * @return int
     */
    public function getForwardLines()
    {
        return $this->forwardLines;
    }

    /**
     * @return string
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @return array
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Check if the get logs query is completed
     *
     * @return bool true if this logs query is completed
     */
    public function isCompleted()
    {
        return $this->progress == 'Complete';
    }
}