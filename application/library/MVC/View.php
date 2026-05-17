<?php
/**
 * View.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use Smarty;

class View extends Smarty
{
    /**
     * switch rendering on/off
     * @var bool render
     */
    public static bool $bRender = true;

    /**
     * switch echo out
     * @var bool
     */
    public static bool $bEchoOut = true;

    /**
     * Current Template Directory
     * @var string
     */
    public string $sTemplateDir;

    /**
     * default Template / Layout; relative path
     * @var string
     */
    public string $sTemplateRelative;

    /**
     * default Template / Layout; absolute path
     * @var string
     */
    public string $sTemplate;

    /**
     * smarty version
     * @var int
     */
    public int $iSmartyVersion;

    /**
     * View constructor.
     * instantiates smarty object and set major smarty configs
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct();

        $this->sTemplateDir = Config::get_MVC_VIEW_TEMPLATE_DIR();

        if (false === file_exists($this->sTemplateDir))
        {
            $this->sTemplateDir = Config::get_MVC_MODULES_DIR() . '/' . Route::getCurrent()->get_module() . '/templates';
        }

        $this->addAbsolutePathToTemplateDir($this->sTemplateDir);
        $this->sTemplate = Config::get_MVC_SMARTY_TEMPLATE_DEFAULT();
        $this->iSmartyVersion = (int) preg_replace ('/[^0-9]+/', '', self::SMARTY_VERSION);
        $this->setCompileDir (Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR());
        $this->setCacheDir (Config::get_MVC_SMARTY_CACHE_DIR());
        $this->caching = Config::get_MVC_SMARTY_CACHE_STATUS();
        $aPlugInDir = array(Config::get_MVC_APPLICATION_PATH() . '/vendor/smarty/smarty/libs/plugins/');
        (!empty(Config::get_MVC_SMARTY_PLUGINS_DIR())) ? $aPlugInDir = array_merge ($aPlugInDir, Config::get_MVC_SMARTY_PLUGINS_DIR()) : false;
        $this->setPluginsDir ($aPlugInDir);
        $this->checkDirs();

        Event::bind('mvc.view.render.off', function() {
            View::$bRender = false;
        });

        Event::bind('mvc.view.render.on', function() {
            View::$bRender = true;
        });

        Event::bind('mvc.view.echoOut.off', function() {
            View::$bEchoOut = false;
        });

        Event::bind('mvc.view.echoOut.on', function() {
            View::$bEchoOut = true;
        });
    }

    /**
     * checks if required dirs exist. If not, it tries to create them
     * @return void
     * @throws \ReflectionException
     */
    protected function checkDirs() : void
    {
        if (!file_exists (Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR()))
        {
            mkdir (Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR());
        }
        if (!file_exists (Config::get_MVC_SMARTY_CACHE_DIR()))
        {
            mkdir (Config::get_MVC_SMARTY_CACHE_DIR());
        }
    }

    /**
     * returns a given template rendered as String
     * @param string $sTemplate
     * @return string
     * @throws \SmartyException
     */
    public function loadTemplateAsString(string $sTemplate = '') : string
    {
        return $this->fetch ('string:' . file_get_contents ($sTemplate, true));
    }

    /**
     * renders a given string and print it out (depending on self::$_bEchoOut)
     * @param string $sTemplateString
     * @return void
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public function renderString(string $sTemplateString = '') : void
    {
        Event::run('mvc.view.renderString.before', $sTemplateString);

        $sRendered = '';

        if (true === self::$bRender)
        {
            $sRendered = $this->fetch('string:' . $sTemplateString);

            if (true === self::$bEchoOut)
            {
                echo $sRendered;
            }
        }

        Event::run('mvc.view.renderString.after', $sRendered);
    }

    /**
     * renders the template $this->sTemplate
     * @return void
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public function render() : void
    {
        Event::run('mvc.view.render.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oView')->set_sValue($this)
                )
        );

        // Load Template and render
        $sTemplate = (true === is_file($this->sTemplate)) ? file_get_contents ($this->sTemplate, true) : '';
        $this->renderString($sTemplate);

        Event::run('mvc.view.render.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oView')->set_sValue($this)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sTemplate')->set_sValue($sTemplate)
                )
        );
    }

    /**
     * Sets the given Template
     * @param string $sTemplate
     * @return void
     */
    public function setTemplate(string $sTemplate = '') : void
    {
        $this->sTemplate = $sTemplate;
    }

    /**
     * set absolute Path to Smarty Template Dir and saves this into includePath
     * @param string $sAbsolutePathToTemplateDir
     * @return void
     * @deprecated use instead: addAbsolutePathToTemplateDir()
     */
    public function setAbsolutePathToTemplateDir(string $sAbsolutePathToTemplateDir = '') : void
    {
        $this->addAbsolutePathToTemplateDir($sAbsolutePathToTemplateDir);
    }

    /**
     * add absolute Path to Smarty Template Dir and add this into includePath
     * @param string $sAbsolutePathToTemplateDir
     * @return void
     */
    public function addAbsolutePathToTemplateDir(string $sAbsolutePathToTemplateDir = '') : void
    {
        if (is_dir($sAbsolutePathToTemplateDir))
        {
            $aIncludePath = explode(PATH_SEPARATOR, get_include_path ());

            if (!in_array($sAbsolutePathToTemplateDir, $aIncludePath))
            {
                $aIncludePath[] = $sAbsolutePathToTemplateDir;
            }

            $sImplodePaths = implode(PATH_SEPARATOR, $aIncludePath);

            set_include_path($sImplodePaths);
        }

        $this->setTemplateDir($sAbsolutePathToTemplateDir);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getSmartyTemplateDefault() : string
    {
        return Config::get_MVC_SMARTY_TEMPLATE_DEFAULT();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getSmartyPlugInsDir() : array
    {
        return Config::get_MVC_SMARTY_PLUGINS_DIR();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getSmartyTemplateCacheDir() : string
    {
        return Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR();
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getSmartyCacheDir() : string
    {
        return Config::get_MVC_SMARTY_CACHE_DIR();
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public static function getSmartyCacheStatus() : bool
    {
        return Config::get_MVC_SMARTY_CACHE_STATUS();
    }
}