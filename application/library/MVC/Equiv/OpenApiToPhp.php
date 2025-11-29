<?php

namespace MVC\Equiv;

class OpenApiToPhp
{
    /**
     * @var string[]
     */
    protected static $aMap = array(
        'string' => 'string',
        'number' => 'float',
        'integer' => 'integer',
        'boolean' => 'bool',
        'array' => 'array',
        'object' => 'object',
    );

    /**
     * @param string $sType
     * @return string
     */
    public static function getEquivalentType(string $sType = '') : string
    {
        return (string) (self::$aMap[$sType] ?? 'string');
    }

    /**
     * @return string[]
     */
    public static function getMapArray() : array
    {
        return self::$aMap;
    }
}
