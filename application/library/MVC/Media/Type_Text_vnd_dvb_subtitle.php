<?php
/**
 * Type_Text_vnd_dvb_subtitle.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_vnd_dvb_subtitle
{
    use TraitMediaType;

    /**
     * @reference [Peter_Siebert]; [Michael_Lagally]
     */
    const DESCRIPTION = 'text/vnd.dvb.subtitle';
}