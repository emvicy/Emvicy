<?php
/**
 * Type_Multipart_form_data.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Multipart_form_data
{
    use TraitMediaType;

    /**
     * @reference [RFC 7578]
     */
    const DESCRIPTION = 'multipart/form-data';
}