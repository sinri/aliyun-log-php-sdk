<?php


namespace sinri\aliyun\sls;


class ProtocolBufferEnum
{

    /**
     * I do not know what this class or this method should do, just stop the warnings
     * @var array
     */
    protected static $_values;

    public static function toString($value)
    {
        if (is_null($value))
            return null;
        if (array_key_exists($value, self::$_values))
            return self::$_values[$value];
        return 'UNKNOWN';
    }
}