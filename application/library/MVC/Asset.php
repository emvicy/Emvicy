<?php
/**
 * Asset.php
 * @usage Asset::init()->get('User.email.form.markup');
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
     * @var \MVC\Asset|null
     */
    protected static ?Asset $_oInstance = null;

    /**
     * @param string $sPathAbs
     * @return \MVC\ArrDot|\MVC\Asset
     */
    public static function init(string $sPathAbs = ''): ArrDot|Asset
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self(
                (true === file_exists($sPathAbs))
                    ? Yaml::parseFile($sPathAbs)
                    : array()
            );
        }

        return self::$_oInstance;
    }
}
