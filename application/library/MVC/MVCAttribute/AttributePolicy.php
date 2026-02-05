<?php
/**
 * AttributePolicy.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\MVCAttribute;
use Attribute;

#[\Attribute]
class AttributePolicy
{
    public function __construct(array $aPolicyFile = array())
    {

    }
}
