<?php
/**
 * Type_Application_vnd_oma_push.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oma_push
{
    use TraitMediaType;

    /**
     * @reference [Bryan_Sullivan]; [OMA]
     */
    const DESCRIPTION = 'application/vnd.oma.push';
}