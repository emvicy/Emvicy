<?php
/**
 * Type_Text_ecmascript_OBSOLETED_in_favor_of_text_javascript.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_ecmascript_OBSOLETED_in_favor_of_text_javascript
{
    use TraitMediaType;

    /**
     * @reference [RFC 9239]
	 * @deprecated OBSOLETED in favor of text/javascript
     */
    const DESCRIPTION = 'text/ecmascript';
}