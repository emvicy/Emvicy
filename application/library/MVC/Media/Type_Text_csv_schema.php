<?php
/**
 * Type_Text_csv_schema.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_csv_schema
{
    use TraitMediaType;

    /**
     * @reference [National_Archives_UK]; [David_Underdown]
     */
    const DESCRIPTION = 'text/csv-schema';
}