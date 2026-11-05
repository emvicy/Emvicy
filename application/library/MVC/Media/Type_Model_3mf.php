<?php
/**
 * Type_Model_3mf.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Model_3mf
{
    use TraitMediaType;

    /**
     * @reference [http://www.3mf.io/specification]; [_3MF]; [Michael_Sweet]
     */
    const DESCRIPTION = 'model/3mf';
}