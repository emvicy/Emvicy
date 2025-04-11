<?php
/**
 * Route.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTRoute;
use MVC\MVCAbstract\AbstractRouteConcrete;

class Route extends AbstractRouteConcrete
{
    /**
     * @param string $sRouteClassConcrete
     * @return void
     * @throws \ReflectionException
     */
    public static function init(string $sRouteClassConcrete = '') : void
    {
        Event::run('mvc.route.init.before');

        // fallback; default
        (true === empty($sRouteClassConcrete))
            ? $sRouteClassConcrete = ($GLOBALS['aConfig']['MVC_ROUTE_CLASS'] ?? '\MVC\_ConcreteRoute')
            : false
        ;

        if (false === in_array('MVC\\MVCInterface\\InterfaceRoute', class_implements($sRouteClassConcrete)))
        {
            $sMsg = "# ERROR\nMake sure `" . $sRouteClassConcrete . "` **implements** `\MVC\MVCInterface\InterfaceRoute`" . "\n\n";
            Error::error(trim(strip_tags($sMsg)));
            echo (true === Request::in()->get_isCli())
                ? $sMsg
                : \Parsedown::instance()->text($sMsg)
            ;
            stop();
        }

        // save as classvar
        self::$sRouteClassConcrete = $sRouteClassConcrete;

        // init concrete
        self::$sRouteClassConcrete::init();

        Event::run('mvc.route.init.after');
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function any(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        self::$sRouteClassConcrete::any($sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param array  $aMethod
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function mix(array $aMethod = array(), string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        foreach ($aMethod as $sMethod)
        {
            self::$sRouteClassConcrete::add(strtoupper($sMethod), $sPath, $sClassMethod, $mOptional, $sTag);
        }
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function get(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        self::$sRouteClassConcrete::add('GET', $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function post(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        self::$sRouteClassConcrete::add('POST', $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function put(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        self::$sRouteClassConcrete::add('PUT', $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function patch(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        self::$sRouteClassConcrete::add('PATCH', $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function options(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = '') : void
    {
        self::$sRouteClassConcrete::add('OPTIONS', $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function delete(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void
    {
        self::$sRouteClassConcrete::add('DELETE', $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param string $sRequestMethod
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function add(string $sRequestMethod = '*', string $sPath = '', string $sClassMethod = '', mixed $mOptional = null, string $sTag = '') : void
    {
        self::$sRouteClassConcrete::add($sRequestMethod, $sPath, $sClassMethod, $mOptional, $sTag);
    }

    /**
     * @param bool $bWildcardsOnly
     * @return array
     */
    public static function getIndices(bool $bWildcardsOnly = false) : array
    {
        return self::$sRouteClassConcrete::getIndices($bWildcardsOnly);
    }

    /**
     * @example Route::getRouteIndexArrayOnKey('query', Config::get_MVC_ROUTING_FALLBACK())
     *          returns [0 => '/403/', 1 => '/404/']
     * @param string $sKey
     * @param string $sValue
     * @return array
     */
    public static function getRouteIndexArrayOnKey(string $sKey = 'query', string $sValue = '') : array
    {
        return self::$sRouteClassConcrete::getRouteIndexArrayOnKey($sKey, $sValue);
    }

    /**
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    public static function getCurrent() : DTRoute
    {
        return self::$sRouteClassConcrete::getCurrent();
    }

    /**
     * @param string $sPath
     * @return string
     * @throws \ReflectionException
     */
    public static function getIndexOnWildcard(string $sPath = '') : string
    {
        return self::$sRouteClassConcrete::getIndexOnWildcard($sPath);
    }

    /**
     * @param string $sPath
     * @return string
     * @throws \ReflectionException
     */
    public static function getPathOnPlaceholderIndex(string $sPath = '') : string
    {
        return self::$sRouteClassConcrete::getPathOnPlaceholderIndex($sPath);
    }

    /**
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function handleFallback() : DTRoute
    {
        return self::$sRouteClassConcrete::handleFallback();
    }

    /**
     * returns DTRoute object at first matching tag | null if not found
     * @example Route::getOnTag()
     *          Route::getOnTag('home')
     *          Route::getOnTag('home')->get_additional()
     * @param string $sTag
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    public static function getOnTag(string $sTag = '') : DTRoute
    {
        return self::$sRouteClassConcrete::getOnTag($sTag);
    }

    /**
     * returns assoc array DTRoute where keys are the tags of its DTRoute
     * @example Route::getTagList()
     *          Route::getTagList()['home']
     *          Route::getTagList()['home']->get_additional()
     * @return array|\MVC\DataType\DTRoute[]
     */
    public static function getTagList() : array
    {
        return self::$sRouteClassConcrete::getTagList();
    }

    /**
     * @param array $aPathParam
     * @return void
     * @throws \ReflectionException
     */
    public static function setPathParam(array $aPathParam = array()) : void
    {
        self::$sRouteClassConcrete::setPathParam($aPathParam);
    }
}