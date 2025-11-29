<?php

namespace MVC\Equiv;
class PhpToOpenApi
{
    /**
     * @var string[]
     */
    protected static $aMap = array(
        'string' => 'string',
        'int' => 'integer',
        'integer' => 'integer',
        'float' => 'number',
        'double' => 'number',
        'bool' => 'boolean',
        'boolean' => 'boolean',
        'array' => 'array',
        'object' => 'object',
        'null' => 'string', # since openapi3: add 'nullable: true' to your openapi spec
        'resouce' => 'string',
    );

    /**
     * @param string $sType
     * @return string
     */
    public static function getEquivalentType(string $sType = '')
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
