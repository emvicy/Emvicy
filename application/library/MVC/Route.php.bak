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

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\DataType\DTRoute;
use MVC\MVCInterface\InterfaceRoute;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;

class Route implements InterfaceRoute
{
    /**
     * @var DTRoute[]
     */
    public static array $aRoute = array();

    /**
     * @var array
     */
    public static array $aMethod = array();

    /**
     * @var array
     */
    public static array $aMethodRoute = array();

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function init() : void
    {
        Event::run('mvc.route.init.before');

        foreach (array_unique(Config::get_MVC_ROUTING_DIR()) as $sRoutingDir)
        {
            if (true === file_exists($sRoutingDir))
            {
                //  require recursively all php files in module's routing dir
                /** @var \SplFileInfo $oSplFileInfo */
                foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($sRoutingDir)) as $oSplFileInfo)
                {
                    if ('php' === strtolower($oSplFileInfo->getExtension()))
                    {
                        require_once $oSplFileInfo->getPathname();
                    }
                }
            }
        }

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
        self::add('*', $sPath, $sClassMethod, $mOptional, $sTag);
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
            self::add(strtoupper($sMethod), $sPath, $sClassMethod, $mOptional, $sTag);
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
        self::add('GET', $sPath, $sClassMethod, $mOptional, $sTag);
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
        self::add('POST', $sPath, $sClassMethod, $mOptional, $sTag);
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
        self::add('PUT', $sPath, $sClassMethod, $mOptional, $sTag);
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
        self::add('PATCH', $sPath, $sClassMethod, $mOptional, $sTag);
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
        self::add('OPTIONS', $sPath, $sClassMethod, $mOptional, $sTag);
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
        self::add('DELETE', $sPath, $sClassMethod, $mOptional, $sTag);
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
        list($sClass, $sMethod) = explode('::', $sClassMethod);
        (true === empty($mOptional)) ? $mOptional = null : false;
        $aRequestMethodAssigned = array(strtoupper($sRequestMethod));
        $oReflectionClass = new ReflectionClass($sClass);

        // save all assigned Request Methods
        if (isset(self::$aRoute[$sPath]))
        {
            $aRequestMethodAssigned = self::$aRoute[$sPath]->get_methodsAssigned();

            if (false === in_array($sRequestMethod, $aRequestMethodAssigned, true))
            {
                $aRequestMethodAssigned[] = $sRequestMethod;
            }
        }

        // save tag
        ((true === empty($sTag)) ? $sTag = Strings::seofy((('*' === $sRequestMethod) ? 'any' : $sRequestMethod) . '.' . $sPath) : false);
        ((true === empty($sTag)) ? $sTag = Strings::seofy((('*' === $sRequestMethod) ? 'any' : $sRequestMethod) . '.' . $sClass . '-' . $sMethod . '-' . implode('-', $aRequestMethodAssigned)) : false);

        // create DTRoute object
        $oDTRoute = DTRoute::create()
            ->set_path($sPath)
            ->set_requestMethod(strtoupper($sRequestMethod))
            ->set_methodsAssigned($aRequestMethodAssigned)
            ->set_query($sClassMethod)
            ->set_module(current(preg_split('%\\\%', $sClass, -1, PREG_SPLIT_NO_EMPTY)))
            ->set_class($sClass)
            ->set_classFile($oReflectionClass->getFileName())
            ->set_method($sMethod)
            ->set_additional($mOptional)
            ->set_tag($sTag)
        ;

        self::$aRoute[$sPath] = $oDTRoute;

        #--------------------------

        // add Route to classVar infos
        foreach ($aRequestMethodAssigned as $sMethodAssigned)
        {
            if (false === isset(self::$aMethod[strtolower($sMethodAssigned)]))
            {
                self::$aMethod[strtolower($sMethodAssigned)] = array();
            }

            if (false === in_array($sPath, self::$aMethod[strtolower($sMethodAssigned)], true))
            {
                self::$aMethod[strtolower($sMethodAssigned)][] = $sPath;
                self::$aMethodRoute[$sMethodAssigned][$sPath] = $oDTRoute; // initial
            }

            // update
            self::$aMethodRoute[$sMethodAssigned][$sPath]->set_methodsAssigned($oDTRoute->get_methodsAssigned());
        }
    }

    /**
     * @param bool $bWildcardsOnly
     * @return array
     */
    public static function getIndices(bool $bWildcardsOnly = false) : array
    {
        $aIndex = array_keys(self::$aRoute);

        if (false === $bWildcardsOnly)
        {
            return $aIndex;
        }

        // wildcards only
        $aIndex = preg_grep("/\/\*/i", $aIndex);
        (false === $aIndex) ? $aIndex = array() : false;

        /** @var array */
        return $aIndex;
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
        $aRoute = Convert::objectToArray(self::$aRoute);
        $aIndex = array();

        foreach ($aRoute as $iIndex => $aValue)
        {
            (strtolower(($aValue[$sKey] ?? '')) === strtolower($sValue)) ? $aIndex[] = $iIndex : false;
        }

        return $aIndex;
    }

    /**
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    public static function getCurrent() : DTRoute
    {
        // Request
        $sPath = Request::in()->get_path();
        $sRequestMethod = Request::in()->get_requestMethod();

        // Path 1:1 Match; e.g: /foo/bar/
        if (!is_null((self::$aMethodRoute[$sRequestMethod][$sPath] ?? null))) # concrete
        {
            return self::$aMethodRoute[$sRequestMethod][$sPath];
        }
        elseif (!is_null((self::$aMethodRoute['*'][$sPath] ?? null))) # any
        {
            return self::$aMethodRoute['*'][$sPath];
        }

        // Path 1:1 + Wildcard (/*) Match; e.g: /foo/bar/*
        $sIndex = self::getIndexOnWildcard($sPath);

        if (!empty(self::$aMethodRoute[$sRequestMethod][$sIndex])) # concrete
        {
            return self::$aMethodRoute[$sRequestMethod][$sIndex];
        }
        elseif (!empty(self::$aMethodRoute['*'][$sIndex])) # any
        {
            return self::$aMethodRoute['*'][$sIndex];
        }

        // Path Placeholder Match; e.g: /foo/bar/:id/:name/*
        $sIndex = self::getPathOnPlaceholderIndex($sPath);

        if (!empty((self::$aMethodRoute[$sRequestMethod][$sIndex] ?? null))) # concrete
        {
            return self::$aMethodRoute[$sRequestMethod][$sIndex];
        }
        elseif (!empty((self::$aMethodRoute['*'][$sIndex] ?? null))) # any
        {
            return self::$aMethodRoute['*'][$sIndex];
        }

        return self::handleFallback();
    }

    /**
     * @param string $sPath
     * @return string
     * @throws \ReflectionException
     */
    public static function getIndexOnWildcard(string $sPath = '') : string
    {
        $aIndex = self::getIndices(true);

        foreach ($aIndex as $sIndex)
        {
            // cut off "*"
            $sIndexCutOff = substr($sIndex, 0, -1);

            if (true === str_starts_with($sPath, $sIndexCutOff))
            {
                $aPathParam['_tail'] = substr($sPath, strlen($sIndexCutOff));
                self::setPathParam($aPathParam);

                return (string) $sIndex;
            }
        }

        return '';
    }

    /**
     * @param string $sPath
     * @return string
     * @throws \ReflectionException
     */
    public static function getPathOnPlaceholderIndex(string $sPath = '') : string
    {
        // Request
        $aPartPath = preg_split('@/@', $sPath, -1, PREG_SPLIT_NO_EMPTY);
        $iLengthPath = count($aPartPath);
        $aIndex = self::getIndices();

        // iterate routes
        foreach ($aIndex as $sValue)
        {
            $aRoute = preg_split('@/@', $sValue, -1, PREG_SPLIT_NO_EMPTY);
            $iLengthRoute = count($aRoute);

            // skip routes without * at the end if they are shorter than the requested path
            if (($iLengthRoute < $iLengthPath) && ('*' !== current(array_reverse($aRoute))))
            {
                continue;
            }

            $aPathParam = array();

            // compare each part of the route
            foreach ($aRoute as $iKey => $sPart)
            {
                // part is wildcard; save tail, remove wildcard from array
                if ('*' === $sPart)
                {
                    $aTail = array_slice($aPartPath, $iKey);
                    $aPathParam['_tail'] = (true === empty($aTail)) ? '' : implode('/', $aTail) . (('/' === (substr($sPath, -1))) ? '/' : '');
                    unset($aRoute[$iKey]);
                }

                // part is a variable; save key value
                $sKey = '';
                (':' === (substr($sPart, 0, 1))) ? $sKey = str_replace(':', '', $sPart) : false;
                ('{}' === (substr($sPart, 0, 1) . substr($sPart, -1))) ? $sKey = str_replace('}', '', str_replace('{', '', $sPart)) : false;

                if (false === empty($sKey))
                {
                    $aRoute[$iKey] = ($aPartPath[$iKey] ?? null);     # replace variable by concrete value from path
                    $aPathParam[$sKey] = ($aPartPath[$iKey] ?? null); # save PathParam
                }

                // add leading and/or trailing slashes if route was defined so
                $sRoute = ('/' === (substr($sValue, 0, 1))) ? '/' : '';
                $sRoute.= implode('/', $aRoute) . (('*' === $sPart) ? '/' . $aPathParam['_tail'] : ''); # add tail if part is a wildcard
                $sRoute.= ('/' === (substr($sValue, -1))) ? '/' : '';
                $sRoute = str_replace('//', '/', $sRoute);

                // now check if path and route do match
                if ($sPath === $sRoute && $iLengthPath >= $iLengthRoute)
                {
                    (false === empty($aPathParam)) ? self::setPathParam($aPathParam) : false;

                    return $sValue;
                }
            }
        }

        return '';
    }

    /**
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function handleFallback() : DTRoute
    {
        $sIndex = current(self::getRouteIndexArrayOnKey('query', Config::get_MVC_ROUTING_FALLBACK()));

        /** @var DTRoute $oRoutingCurrent */
        $oRoutingCurrent = (self::$aRoute[$sIndex] ?? array());

        if (true === empty($oRoutingCurrent))
        {
            return DTRoute::create();
        }

        Event::run (
            'mvc.route.handleFallback.after',
            DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sRequest')->set_sValue(Request::in()->get_requestUri()))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sForward')->set_sValue($sIndex))
        );

        return $oRoutingCurrent;
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
        if (true === empty($sTag))
        {
            return DTRoute::create();
        }

        // convert only once at runtime
        if (false === Registry::isRegistered('mvc_route_getOnTag_aRoute'))
        {
            $aRoute = Convert::objectToArray(self::$aRoute);
            Registry::set('mvc_route_getOnTag_aRoute', $aRoute);
        }

        $aRoute = Registry::get('mvc_route_getOnTag_aRoute');
        $iKey = array_search(
            // what to search for
            $sTag,
            // Array to search in & Key to look after
            array_column($aRoute, 'tag')
        );

        return self::$aRoute[array_keys($aRoute)[$iKey]];
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
        $aTag = array();

        foreach (self::$aMethodRoute as $aRoute)
        {
            foreach ($aRoute as $oDTRoute)
            {
                // skip
                if (true === empty($oDTRoute))
                {
                    continue;
                }

                /** @var DTRoute[] $aTag */
                $aTag[$oDTRoute->get_tag()] = $oDTRoute;
            }
        }

        return $aTag;
    }

    /**
     * @param array $aPathParam
     * @return void
     * @throws \ReflectionException
     */
    public static function setPathParam(array $aPathParam = array()) : void
    {
        Registry::set('aPathParam', $aPathParam);

        (true === Registry::isRegistered('oDTRequestIn'))
            ? $oDTRequestIn = Registry::get('oDTRequestIn')
            : $oDTRequestIn = Request::in()
        ;

        $oDTRequestIn->set_pathParamArray($aPathParam);
        Registry::set('oDTRequestIn', $oDTRequestIn);
    }
}