<?php
/**
 * Type_Application_rpki_publication.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_rpki_publication
{
    use TraitMediaType;

    /**
     * @reference [RFC 8181]
     */
    const DESCRIPTION = 'application/rpki-publication';
}