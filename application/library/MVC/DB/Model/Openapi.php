<?php
/**
 * Openapi.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\DB\Model;

use MVC\Cache;
use MVC\Config;
use Symfony\Component\Yaml\Yaml;

class Openapi
{
    /**
     * builds an openapi.yaml "DTTables.yaml" in the primary module's DataType folder based on data type classes of the
     * DB tables
     * @param \MVC\DB\Model\DbInit|null $oDB
     * @param string                    $sDtClassPrefix
     * @param string                    $sOpenApiVersion
     * @param string                    $sYamlFileName
     * @return string /absolute/path/to/file.yaml | empty=fail
     * @throws \ReflectionException
     */
    public static function createDTYamlOnDTClasses(DbInit $oDB = null, string $sDtClassPrefix = 'DT', string $sOpenApiVersion = '3.0.1', string $sYamlFileName = 'DTTables.yaml') : string
    {
        if (null === $oDB)
        {
            return '';
        }

        Cache::flushCache();

        (true === empty($sDtClassPrefix)) ? $sDtClassPrefix = 'DT' : false;
        (true === empty($sOpenApiVersion)) ? $sOpenApiVersion = '3.0.1' : false;

        $sDTFolderPre = '\\' . Config::get_MVC_MODULE_PRIMARY_NAME() . '\\' . basename(Config::get_MVC_MODULE_PRIMARY_DATATYPE_DIR());
        $sYamlFile = Config::get_MVC_MODULE_PRIMARY_DATATYPE_DIR() . '/' . basename($sYamlFileName);
        $aClassVar = get_class_vars(get_class($oDB));
        $aTmp = [
            'components' => [
                'schemas' => []
            ]
        ];

        foreach ($aClassVar as $sProperty => $mFoo)
        {
            $bMethodExists = method_exists($oDB::$$sProperty, 'getFieldInfo');

            if (false === $bMethodExists)
            {
                continue;
            }

            $aFieldInfo = $oDB::$$sProperty->getFieldInfo();
            $sClass = $oDB->getDocCommentValueOfProperty($sProperty);
            $sDtClassName = $sDtClassPrefix . str_replace('\\', '', $sClass);
            $sDTofClass = $sDTFolderPre . '\\' . $sDtClassName;

            /** @var \MVC\DB\DataType\DB\TableDataType $oDtTmp */
            $oDtTmp = $sDTofClass::create();

            $aTmp['components']['schemas'][$sDtClassName] = array();
            $aTmp['components']['schemas'][$sDtClassName]['type'] = 'object';
            $aTmp['components']['schemas'][$sDtClassName]['properties'] = array();

            foreach ($oDtTmp->getPropertyArray() as $sKey => $mValue)
            {
                $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['type'] = self::getType(gettype($mValue), get($aFieldInfo[$sKey]['Type'], ''));

                if ('enum' === get($aFieldInfo[$sKey]['_type']))
                {
                    $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['enum'] = get($aFieldInfo[$sKey]['_typeValue']);
                }
                else
                {
                    $sFormat = self::getFormat(get($aFieldInfo[$sKey]['_type'], ''));
                    (false === empty($sFormat)) ? $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['format'] = $sFormat : false;

                    $bNullable = self::isNullable($mValue);
                    (true === $bNullable) ? $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['nullable'] = true : false;

                    (is_numeric(get($aFieldInfo[$sKey]['_typeValue'])) && 'string' === get($aFieldInfo[$sKey]['_php']))
                        ? $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['maxLength'] = (int) get($aFieldInfo[$sKey]['_typeValue'])
                        : false
                    ;

                    $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['default'] = self::getDefault($mValue);
                }

                (null !== get($aFieldInfo[$sKey]['Type']))
                    ? $aTmp['components']['schemas'][$sDtClassName]['properties'][$sKey]['description'] = $aFieldInfo[$sKey]['Type']
                    : false
                ;
            }
        }

        $sYaml =
            trim('openapi: ' . $sOpenApiVersion
                 . "\n"
                 // array to yaml
                 . Yaml::dump($aTmp, 100, 2) /** @see https://symfony.com/doc/current/components/yaml.html */
            );

        file_put_contents(
            $sYamlFile,
            $sYaml
        );

        return $sYamlFile;
    }

    /**
     * @param mixed $mValue
     * @return mixed|string
     */
    protected static function getDefault(mixed $mValue)
    {
        if ('null' === strtolower($mValue))
        {
            return '';
        }

        return $mValue;
    }

    /**
     * @param string $sType
     * @param string $sFieldInfoType
     * @return string
     */
    protected static function getType(string $sType = '', string $sFieldInfoType = '')
    {
        if (str_starts_with(strtolower($sFieldInfoType), 'varchar'))
        {
            $sType = 'string';
        }
        if (str_starts_with(strtolower($sFieldInfoType), 'int'))
        {
            $sType = 'integer';
        }
        if (str_ends_with(strtolower($sFieldInfoType), 'text'))
        {
            $sType = 'string';
        }

        $aType = array('string', 'number', 'integer', 'boolean', 'array');

        if (false === in_array($sType, $aType))
        {
            $sType = 'string';
        }

        return $sType;
    }

    /**
     * @param string $sType
     * @return string
     */
    protected static function getFormat(string $sType = '')
    {
        $sFormat = '';

        if('date' === $sType)
        {
            $sFormat = 'date';
        }

        if('datetime' === $sType)
        {
            $sFormat = 'date-time';
        }

        return $sFormat;
    }

    /**
     * @param string $mType
     * @return bool
     */
    protected static function isNullable(mixed $mType = '')
    {
        $bNullable = false;

        if (true === is_null($mType) || 'null' === strtolower($mType))
        {
            $bNullable = true;
        }

        return $bNullable;
    }
}