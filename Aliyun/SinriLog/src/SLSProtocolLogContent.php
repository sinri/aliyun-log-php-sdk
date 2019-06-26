<?php


namespace sinri\aliyun\sls;


use Exception;

class SLSProtocolLogContent
{
    private $_unknown;

    /**
     * SLSProtocolLogContent constructor.
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
            //var_dump("Log_Content: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
            switch ($field) {
                case 1:
                    ASSERT('$wire == 2');
                    $len = ProtocolBuffer::read_varint($fp, $limit);
                    if ($len === false)
                        throw new Exception('Protobuf::read_varint returned false');
                    if ($len > 0)
                        $tmp = fread($fp, $len);
                    else
                        $tmp = '';
                    if ($tmp === false)
                        throw new Exception("fread($len) returned false");
                    $this->key_ = $tmp;
                    $limit -= $len;
                    break;
                case 2:
                    ASSERT('$wire == 2');
                    $len = ProtocolBuffer::read_varint($fp, $limit);
                    if ($len === false)
                        throw new Exception('Protobuf::read_varint returned false');
                    if ($len > 0)
                        $tmp = fread($fp, $len);
                    else
                        $tmp = '';
                    if ($tmp === false)
                        throw new Exception("fread($len) returned false");
                    $this->value_ = $tmp;
                    $limit -= $len;
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
        if (!is_null($this->key_)) {
            fwrite($fp, "\x0a");
            ProtocolBuffer::write_varint($fp, strlen($this->key_));
            fwrite($fp, $this->key_);
        }
        if (!is_null($this->value_)) {
            fwrite($fp, "\x12");
            ProtocolBuffer::write_varint($fp, strlen($this->value_));
            fwrite($fp, $this->value_);
        }
    }

    public function size()
    {
        $size = 0;
        if (!is_null($this->key_)) {
            $l = strlen($this->key_);
            $size += 1 + ProtocolBuffer::size_varint($l) + $l;
        }
        if (!is_null($this->value_)) {
            $l = strlen($this->value_);
            $size += 1 + ProtocolBuffer::size_varint($l) + $l;
        }
        return $size;
    }

    public function validateRequired()
    {
        if ($this->key_ === null) return false;
        if ($this->value_ === null) return false;
        return true;
    }

    public function __toString()
    {
        return ''
            . ProtocolBuffer::toString('unknown', $this->_unknown)
            . ProtocolBuffer::toString('key_', $this->key_)
            . ProtocolBuffer::toString('value_', $this->value_);
    }

    // required string Key = 1;

    private $key_ = null;

    public function clearKey()
    {
        $this->key_ = null;
    }

    public function hasKey()
    {
        return $this->key_ !== null;
    }

    public function getKey()
    {
        if ($this->key_ === null) return ""; else return $this->key_;
    }

    public function setKey($value)
    {
        $this->key_ = $value;
    }

    // required string Value = 2;

    private $value_ = null;

    public function clearValue()
    {
        $this->value_ = null;
    }

    public function hasValue()
    {
        return $this->value_ !== null;
    }

    public function getValue()
    {
        if ($this->value_ === null) return ""; else return $this->value_;
    }

    public function setValue($value)
    {
        $this->value_ = $value;
    }

    // @@protoc_insertion_point(class_scope:Log.Content)
}