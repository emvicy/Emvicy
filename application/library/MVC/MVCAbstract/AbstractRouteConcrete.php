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
     * @var DTRoute[]
     */
    public static array $aRoute = array();

    /**
     * @var array
     */
    public static array $aTag = array();

    /**
     * @var array
     */
    public static array $aMethod = array();

    /**
     * @var array
     */
    public static array $aMethodRoute = array();
}