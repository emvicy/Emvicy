<?php

namespace App\Model;

use MVC\Config;
use MVC\Event;
use MVC\Registry;
use MVC\Route;
use MVC\Strings;

class Menu
{
    /**
     * @var string
     */
    protected static string $sRegistryKeyPrefix = __CLASS__ . '.';

    /**
     * @param array  $aMenuConfig                   default=array(); loading from Config::MODULE()['Menu']
     * @param bool   $bGetPropertiesFromRouteOnTag  default=false
     * @param string $sCallback                     default='\App\Model\Menu::buildBootstrap5Menu'
     * @return void
     * @throws \ReflectionException
     */
    public static function build(array $aMenuConfig = array(), bool $bGetPropertiesFromRouteOnTag = false, string $sCallback = '\App\Model\Menu::buildBootstrap5Menu'): void
    {
        // try to load module's Menu config if missing in param
        (true === empty($aMenuConfig))
            ? $aMenuConfig = (Config::MODULE()['Menu'] ?? array())
            : false
        ;
        Event::run('app.model.menu.build.before', $aMenuConfig);

        // walk config array and build menus
        foreach ($aMenuConfig as $sMenuName => $aMenu)
        {
            self::set(
                $sMenuName,
                call_user_func($sCallback, $aMenu, false, $bGetPropertiesFromRouteOnTag)
            );
        }

        Event::run('app.model.menu.build.after', $aMenuConfig);
    }

    /**
     * @param string $sMenuName
     * @return string
     * @throws \ReflectionException
     */
    public static function get(string $sMenuName = ''): string
    {
        $sMenuName = self::$sRegistryKeyPrefix . Strings::seofy($sMenuName);

        if (true === Registry::isRegistered($sMenuName))
        {
            return (string) Registry::get($sMenuName);
        }

        return '';
    }

    /**
     * @param string $sMenuName
     * @param string $sMarkup
     * @return void
     */
    protected static function set(string $sMenuName = '', string $sMarkup = ''): void
    {
        $sMenuName = self::$sRegistryKeyPrefix . Strings::seofy($sMenuName);

        Registry::set($sMenuName, $sMarkup);
    }

    #-------------------------------------------------------------------------------------------------------------------
    # menu builder

    /**
     * @param      $aMenu
     * @param bool $bIsSub
     * @param bool $bGetProptertiesFromRouteOnTag
     * @return string
     * @throws \ReflectionException
     */
    public static function buildBootstrap5Menu($aMenu, bool $bIsSub = false, bool $bGetProptertiesFromRouteOnTag = false): string
    {
        $sAttribute = (!$bIsSub)
            ? ' class="navbar-nav me-auto mb-2 mb-md-0"'
            : ' class="dropdown-menu shadow"';
        $sMenu = "<ul" . $sAttribute . ">" . "\n";

        foreach ($aMenu as $sId => $aProperty)
        {
            /*
             * If only the simple notation in the menu config with TAGs is used, then resolve here: get Path and Title from Route
             */
            if (true === $bGetProptertiesFromRouteOnTag)
            {
                if (is_array($aProperty))
                {
                    $aSub = $aProperty;
                    $aProperty = $sId;
                }

                $oRoute = Route::getOnTag($aProperty);
                $sId = $aProperty;
                $aProperty = [
                    // cut off any * from path ending
                    'sUrl' => (true === str_ends_with($oRoute->get_path(), '*')) ? substr($oRoute->get_path(), 0, -1) : $oRoute->get_path(),
                    'sText' => ((true === is_object($oRoute->get_additional())) ? $oRoute->get_additional()->get_sTitle() : $sId)
                ];

                if (isset($aSub))
                {
                    $aProperty['sub'] = $aSub;
                    unset($aSub);
                }
            }

            foreach ($aProperty as $sKey => $mValue)
            {
                if (is_array($mValue))
                {
                    $mSub = self::buildBootstrap5Menu($mValue, true, $bGetProptertiesFromRouteOnTag);
                }
                else
                {
                    $mSub = null;
                    $$sKey = $mValue; # <= vars like $sText will be set dynamically here
                }
            }

            if (!isset($sUrl))
            {
                $sUrl = $sId;
            }

            // controlling
            if (null === $mSub)
            {
                if (true === $bIsSub)
                {
                    $sMenu .= "\n" . '<li data-isSubmenu="' .   (int) $bIsSub . '">' . "\n";
                    $sMenu.= "\t" . '<a class="dropdown-item ' . ((true === isset($a_Class) && null !== $a_Class) ? $a_Class : '') . '" href="' . ((null === $mSub) ? $sUrl : '') . '" ' . ((true === isset($a_Attribute) && null !== $a_Attribute) ? $a_Attribute : '') . '>' . "\n";
                }
                else
                {
                    $sMenu .= "\n" . '<li class="nav-item" data-isSubmenu="' .   (int) $bIsSub . '">' . "\n";
                    $sMenu.= "\t" . '<a class="nav-link ' . ((true === isset($a_Class) && null !== $a_Class) ? $a_Class : '') . '" aria-current="page" href="' . ((null === $mSub) ? $sUrl : '') . '" ' . ((true === isset($a_Attribute) && null !== $a_Attribute) ? $a_Attribute : '') . '>' . "\n";
                }
            }
            else
            {
                $sMenu .= "\n" . '<li class="nav-item dropdown" data-isDropDown="' .   (bool) $mSub . '" data-isSubmenu="' .   (int) $bIsSub . '">' . "\n";
                $sMenu.= "\t" . '<a class="nav-link dropdown-toggle ' . ((true === isset($a_Class) && null !== $a_Class) ? $a_Class : '') . '" href="' . ((null === $mSub) ? $sUrl : '') . '" role="button" data-bs-toggle="dropdown" aria-expanded="false" ' . ((true === isset($a_Attribute) && null !== $a_Attribute) ? $a_Attribute : '') . '>' . "\n";
            }

            $sMenu.= "\t\t" . $sText . "\n";
            $sMenu.= "\t" . '</a>' . "\n";
            $sMenu.= $mSub;
            $sMenu.= '</li>' . "\n";

            unset($sUrl, $sText, $mSub, $a_Class, $a_Attribute);
        }

        return $sMenu . "</ul>" . "\n";
    }
}