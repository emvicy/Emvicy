<?php
/**
 * Type_Application_cid.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cid
{
    use TraitMediaType;

    /**
     * @reference [W3C_Verifiable_Credentials_WG][Michael_B_Jones]
     */
    const DESCRIPTION = 'application/cid';
}