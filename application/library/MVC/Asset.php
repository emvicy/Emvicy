<?php
/**
 * Asset.php
 * @usage Asset::init('/path/to/my/asset.yaml')->get('User.email.form.markup');
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use Symfony\Component\Yaml\Yaml;

/**
 * @experimental
 */
class Asset extends ArrDot
{
    /**
     * @var \MVC\Asset[]
     */
    protected static array $_aInstance = [];

    /**
     * @param string $sPathAbs
     * @return mixed|\MVC\Asset|self|null
     */
    public static function init(string $sPathAbs = '')
    {
        if (false === in_array($sPathAbs, self::$_aInstance))
        {
            self::$_aInstance[$sPathAbs] = new self(
                (true === file_exists($sPathAbs))
                    ? Yaml::parseFile($sPathAbs)
                    : array()
            );
        }

        return self::$_aInstance[$sPathAbs];
    }
}
