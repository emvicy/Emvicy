<?php
/**
 * Type_Audio_TETRA_ACELP_BB.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_TETRA_ACELP_BB
{
    use TraitMediaType;

    /**
     * @reference [ETSI]; [Miguel_Angel_Reina_Ortega]
     */
    const DESCRIPTION = 'audio/TETRA_ACELP_BB';
}