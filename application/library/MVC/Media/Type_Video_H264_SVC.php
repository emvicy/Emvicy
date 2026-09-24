<?php
/**
 * Type_Video_H264_SVC.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_H264_SVC
{
    use TraitMediaType;

    /**
     * @reference [RFC 6190]
     */
    const DESCRIPTION = 'video/H264-SVC';
}