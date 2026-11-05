<?php
/**
 * Type_Application_concise_problem_details_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_concise_problem_details_cbor
{
    use TraitMediaType;

    /**
     * @reference [RFC 9290, Section 6.3]
     */
    const DESCRIPTION = 'application/concise-problem-details+cbor';
}