<?php

namespace MVC\Equiv;

class SqlToOpenApi
{
    /**
     * @var string[]
     */
    protected static $aMap = array(

        // string
        'tinyblob' => 'string',
        'blob' => 'string',
        'mediumblob' => 'string',
        'longblob' => 'string',

        'binary' => 'string',
        'varbinary' => 'string',
        'varchar' => 'string',
        'char' => 'string',
        'tinytext' => 'string',
        'text' => 'string',
        'mediumtext' => 'string',
        'longtext' => 'string',
        'enum' => 'string',
        'set' => 'string',

        'date' => 'string',
        'time' => 'string',
        'datetime' => 'string',
        'timestamp' => 'string',
        'year' => 'string',

        'geometry' => 'string',
        'point' => 'string',
        'linestring' => 'string',
        'polygon' => 'string',
        'geometrycollection' => 'string',
        'multilinestring' => 'string',
        'multipoint' => 'string',
        'multipolygon' => 'string',

        'json' => 'string',

        // int
        'tinyint' => 'integer',
        'smallint' => 'integer',
        'mediumint' => 'integer',
        'int' => 'integer',
        'bigint' => 'integer',

        // float
        'float' => 'number',
        'double' => 'number',

        // bool
        'bit' => 'boolean',
        'boolean' => 'boolean',
        'bool' => 'boolean',
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
