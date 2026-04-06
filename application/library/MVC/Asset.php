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
        // backwards compatibility (prior 2026-04-06); returns first element of array
        /** @deprecated wil be rmoved in upcoming releases */
        if (true === empty($sPathAbs))
        {
            return array_first(self::$_aInstance);
        }

        $sIdentifier = md5($sPathAbs);

        if (false === in_array($sIdentifier, self::$_aInstance))
        {
            self::$_aInstance[$sIdentifier] = new self(
                (true === file_exists($sPathAbs))
                    ? Yaml::parseFile($sPathAbs)
                    : array()
            );
        }

        return self::$_aInstance[$sIdentifier];
    }
}
