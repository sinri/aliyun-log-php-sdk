<?php


namespace sinri\aliyun\sls\Models\Request;

/**
 * Class GetContextLogsDIYRequest
 * @package sinri\aliyun\sls\Models\Request
 * @since 1.0.3
 */
class GetContextLogsDIYRequest extends Request
{
    // 上下文查询的时间范围为起始日志的前后一天。

    /**
     * logstorename
     * 待查询日志的Logstore名称。
     * @var string
     */
    private $logstoreName;
    /**
     * Logstore中数据的类型。在GetContextLogs接口中该参数必须为 context_log。
     * @var string
     */
    private $type = 'context_log';
    /**
     * pack_id
     * 起始日志所属的Log Group的唯一标识。
     * @var string
     */
    private $packId;
    /**
     * pack_meta
     * 起始日志在对应Log Group 内的唯一标识。
     * Fetch by use GetLogs API,
     * the query parameter is like "*|with_pack_meta", "error|with_pack_meta", or so
     * @var string
     */
    private $packMeta;
    /**
     * back_lines
     * 指定起始日志往前（上文）的日志条数，取值范围为 (0, 100]。
     * @var int
     */
    private $backLines;
    /**
     * forward_lines
     * 指定起始日志往后（下文）的日志条数，取值范围为 (0, 100]。
     * @var int
     */
    private $forwardLines;

    public function __construct($project, $logstoreName, $packId, $packMeta, $backLines, $forwardLines)
    {
        parent::__construct($project);

        $this->logstoreName = $logstoreName;
        $this->packId = $packId;
        $this->packMeta = $packMeta;
        $this->backLines = $backLines;
        $this->forwardLines = $forwardLines;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLogstoreName()
    {
        return $this->logstoreName;
    }

    /**
     * @param string $logstoreName
     */
    public function setLogstoreName($logstoreName)
    {
        $this->logstoreName = $logstoreName;
    }

    /**
     * @return string
     */
    public function getPackId()
    {
        return $this->packId;
    }

    /**
     * @param string $packId
     */
    public function setPackId($packId)
    {
        $this->packId = $packId;
    }

    /**
     * @return string
     */
    public function getPackMeta()
    {
        return $this->packMeta;
    }

    /**
     * @param string $packMeta
     */
    public function setPackMeta($packMeta)
    {
        $this->packMeta = $packMeta;
    }

    /**
     * @return int
     */
    public function getBackLines()
    {
        return $this->backLines;
    }

    /**
     * @param int $backLines
     */
    public function setBackLines($backLines)
    {
        $this->backLines = $backLines;
    }

    /**
     * @return int
     */
    public function getForwardLines()
    {
        return $this->forwardLines;
    }

    /**
     * @param int $forwardLines
     */
    public function setForwardLines($forwardLines)
    {
        $this->forwardLines = $forwardLines;
    }
}