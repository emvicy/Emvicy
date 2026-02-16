<?php

namespace MVC\MVCInterface;

use MVC\DataType\DTRoute;

interface InterfaceRoute
{
    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function init(): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function any(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param array  $aMethod
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function mix(array $aMethod = array(), string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function get(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function post(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function put(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function patch(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function options(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function delete(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     */
    public static function cli(string $sPath = '', string $sClassMethod = '', mixed $mOptional = '', string $sTag = ''): void;

    /**
     * @param string $sRequestMethod
     * @param string $sPath
     * @param string $sClassMethod
     * @param mixed  $mOptional
     * @param string $sTag
     * @return void
     * @throws \ReflectionException
     */
    public static function add(string $sRequestMethod = '*', string $sPath = '', string $sClassMethod = '', mixed $mOptional = null, string $sTag = ''): void;

    /**
     * @param bool $bWildcardsOnly
     * @return array
     */
    public static function getIndices(bool $bWildcardsOnly = false): array;

    /**
     * @param string $sKey
     * @param string $sValue
     * @return array
     * @example Route::getRouteIndexArrayOnKey('query', Config::get_MVC_ROUTING_FALLBACK())
     *          returns [0 => '/403/', 1 => '/404/']
     */
    public static function getRouteIndexArrayOnKey(string $sKey = 'query', string $sValue = ''): array;

    /**
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     */
    public static function getCurrent(): DTRoute;

    /**
     * @param string $sPath
     * @return string
     * @throws \ReflectionException
     */
    public static function getIndexOnWildcard(string $sPath = ''): string;

    /**
     * @param string $sPath
     * @return string
     * @throws \ReflectionException
     */
    public static function getPathOnPlaceholderIndex(string $sPath = ''): string;

    /**
     * @return mixed
     */
    public static function handleFallback();

    /**
     * returns DTRoute object at first matching tag | null if not found
     * @param string $sTag
     * @return \MVC\DataType\DTRoute
     * @throws \ReflectionException
     * @example Route::getOnTag()
     *          Route::getOnTag('home')
     *          Route::getOnTag('home')->get_additional()
     */
    public static function getOnTag(string $sTag = ''): DTRoute;

    /**
     * returns assoc array DTRoute where keys are the tags of its DTRoute
     * @return array|\MVC\DataType\DTRoute[]
     * @example Route::getTagList()
     *          Route::getTagList()['home']
     *          Route::getTagList()['home']->get_additional()
     */
    public static function getTagList(): array;

    /**
     * @param array $aPathParam
     * @return void
     * @throws \ReflectionException
     */
    public static function setPathParam(array $aPathParam = array()): void;
}