<?php
// Please include the below file before sls_logs.proto.php
//require('Protobuf.php');
namespace sinri\aliyun\sls;


// message Log
use Exception;

class SLSProtocolLog
{
    private $_unknown;

    /**
     * SLSProtocolLog constructor.
     * @param null $in
     * @param int $limit
     * @throws Exception
     */
    function __construct($in = NULL, &$limit = PHP_INT_MAX)
    {
        if ($in !== NULL) {
            if (is_string($in)) {
                $fp = fopen('php://memory', 'r+b');
                fwrite($fp, $in);
                rewind($fp);
            } else if (is_resource($in)) {
                $fp = $in;
            } else {
                throw new Exception('Invalid in parameter');
            }
            $this->read($fp, $limit);
        }
    }

    /**
     * @param $fp
     * @param int $limit
     * @throws Exception
     */
    function read($fp, &$limit = PHP_INT_MAX)
    {
        while (!feof($fp) && $limit > 0) {
            $tag = ProtocolBuffer::read_varint($fp, $limit);
            if ($tag === false) break;
            $wire = $tag & 0x07;
            $field = $tag >> 3;
            //var_dump("Log: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
            switch ($field) {
                case 1:
                    ASSERT('$wire == 0');
                    $tmp = ProtocolBuffer::read_varint($fp, $limit);
                    if ($tmp === false)
                        throw new Exception('Protobuf::read_varint returned false');
                    $this->time_ = $tmp;

                    break;
                case 2:
                    ASSERT('$wire == 2');
                    $len = ProtocolBuffer::read_varint($fp, $limit);
                    if ($len === false)
                        throw new Exception('Protobuf::read_varint returned false');
                    $limit -= $len;
                    $this->contents_[] = new SLSProtocolLogContent($fp, $len);
                    ASSERT('$len == 0');
                    break;
                default:
                    $this->_unknown[$field . '-' . ProtocolBuffer::get_wiretype($wire)][] = ProtocolBuffer::read_field($fp, $wire, $limit);
            }
        }
        if (!$this->validateRequired())
            throw new Exception('Required fields are missing');
    }

    /**
     * @param $fp
     * @throws Exception
     */
    function write($fp)
    {
        if (!$this->validateRequired())
            throw new Exception('Required fields are missing');
        if (!is_null($this->time_)) {
            fwrite($fp, "\x08");
            ProtocolBuffer::write_varint($fp, $this->time_);
        }
        if (!is_null($this->contents_))
            foreach ($this->contents_ as $v) {
                fwrite($fp, "\x12");
                ProtocolBuffer::write_varint($fp, $v->size()); // message
                $v->write($fp);
            }
    }

    public function size()
    {
        $size = 0;
        if (!is_null($this->time_)) {
            $size += 1 + ProtocolBuffer::size_varint($this->time_);
        }
        if (!is_null($this->contents_))
            foreach ($this->contents_ as $v) {
                $l = $v->size();
                $size += 1 + ProtocolBuffer::size_varint($l) + $l;
            }
        return $size;
    }

    public function validateRequired()
    {
        if ($this->time_ === null) return false;
        return true;
    }

    public function __toString()
    {
        return ''
            . ProtocolBuffer::toString('unknown', $this->_unknown)
            . ProtocolBuffer::toString('time_', $this->time_)
            . ProtocolBuffer::toString('contents_', $this->contents_);
    }

    // required uint32 Time = 1;

    private $time_ = null;

    public function clearTime()
    {
        $this->time_ = null;
    }

    public function hasTime()
    {
        return $this->time_ !== null;
    }

    public function getTime()
    {
        if ($this->time_ === null) return 0; else return $this->time_;
    }

    public function setTime($value)
    {
        $this->time_ = $value;
    }

    // repeated .Log.Content Contents = 2;

    private $contents_ = null;

    public function clearContents()
    {
        $this->contents_ = null;
    }

    public function getContentsCount()
    {
        if ($this->contents_ === null) return 0; else return count($this->contents_);
    }

    public function getContents($index)
    {
        return $this->contents_[$index];
    }

    public function getContentsArray()
    {
        if ($this->contents_ === null) return array(); else return $this->contents_;
    }

    public function setContents($index, $value)
    {
        $this->contents_[$index] = $value;
    }

    public function addContents($value)
    {
        $this->contents_[] = $value;
    }

    public function addAllContents(array $values)
    {
        foreach ($values as $value) {
            $this->contents_[] = $value;
        }
    }

    // @@protoc_insertion_point(class_scope:Log)
}





