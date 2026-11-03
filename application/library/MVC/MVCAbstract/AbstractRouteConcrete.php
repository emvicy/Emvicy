<?php
/**
 * RouteConcrete.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\MVCAbstract;

use MVC\DataType\DTRoute;
use MVC\MVCInterface\InterfaceRoute;

abstract class AbstractRouteConcrete implements InterfaceRoute
{
    /**
     * @var string
     */
    protected static $sRouteClassConcrete = '\MVC\_ConcreteRoute';

    /**
     * @deprecated use getter/setter instead
     * @var DTRoute[]
     */
    public static array $aRoute = array();

    /**
     * @deprecated use getter/setter instead
     * @var array
     */
    public static array $aMethod = array();

    /**
     * @deprecated use getter/setter instead
     * @var array
     */
    public static array $aMethodRoute = array();
}