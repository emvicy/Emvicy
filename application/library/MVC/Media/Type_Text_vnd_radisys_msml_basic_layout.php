<?php
/**
 * Type_Text_vnd_radisys_msml_basic_layout.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_vnd_radisys_msml_basic_layout
{
    use TraitMediaType;

    /**
     * @reference [RFC 5707]
     */
    const DESCRIPTION = 'text/vnd.radisys.msml-basic-layout';
}