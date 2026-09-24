<?php
/**
 * Type_Text_grammar_ref_list.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_grammar_ref_list
{
    use TraitMediaType;

    /**
     * @reference [RFC 6787]
     */
    const DESCRIPTION = 'text/grammar-ref-list';
}