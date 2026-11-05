<?php
/**
 * Type_Application_vnd_wfa_dpp.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_wfa_dpp
{
    use TraitMediaType;

    /**
     * @reference [Wi-Fi_Alliance]; [Dr._Jun_Tian]
     */
    const DESCRIPTION = 'application/vnd.wfa.dpp';
}