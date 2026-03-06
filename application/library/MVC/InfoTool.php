<?php
/**
 * InfoTool.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;


use Emvicy\Emvicy;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Smarty;

/**
 * InfoTool
 */
class InfoTool
{
    /**
     * Index constructor.
     * adds Event Listener to 'mvc.view.render.before'
     * starts collecting Infos and save it to Registry
     * @param \Smarty $oView
     * @throws \ReflectionException
     */
    public function __construct(Smarty $oView)
    {
        $oDTRoutingAdditional = Route::getCurrent()->get_additional();

        if (true == empty($oDTRoutingAdditional))
        {
            return;
        }

        // add fully rendered template as 'layout'
        $oView->assign('layout',
            (false === empty($oDTRoutingAdditional->get_sTemplate()))
                ? trim($oView->loadTemplateAsString($oDTRoutingAdditional->get_sTemplate()))
                : ''
        );
        // smarty caching status (before toolbar is injected)
        $oView->assign('smarty_caching_status', $oView->caching);

        // add toolbar at the right time
        Event::bind('mvc.view.render.before', function() use ($oView) {
            $oView->setCaching(false);
            InfoTool::injectToolbar($oView);
            Emvicy::cleartemp();
        });

        // get toolbar values and save them to registry
        Registry::set('aToolbar', $this->collectInfo($oView));
    }

    /**
     * adds the toolbar to the html dom before closing body tag
     * @param \Smarty $oView
     * @return void
     * @throws \DOMException
     * @throws \ReflectionException
     * @throws \SmartyException
     */
    public static function injectToolbar(Smarty $oView): void
    {
        if (false === Registry::isRegistered('aToolbar'))
        {
            return;
        }

        $aToolbar = Registry::get('aToolbar');

        // add sRendered markup of current page
        $aToolbar['sRendered'] = $oView->getTemplateVars('layout');
        $aToolbar['sRenderedHighlight'] = Strings::highlight_html(($aToolbar['sRendered'] ?? ''));
        Registry::set('aToolbar', $aToolbar);

        $sToolBarVarName = 'sToolBar_' . uniqid();
        $sInfoToolSmarty = '{$' . $sToolBarVarName . '}';

        // add toolbar template var to layout
        $oView->assign('aToolbar', $aToolbar, true);
        $oView->assign($sToolBarVarName, $oView->loadTemplateAsString(realpath(__DIR__) . '/templates/infoTool.tpl'), true);

        // disable regular view output
        View::$bEchoOut = false;
        $sHtml = '';

        // inject toolbar var to regular string output via DOM
        if (false === empty(($aToolbar['sRendered'] ?? '')))
        {
            $oDom = new \DOMDocument('', '');

            // prevent error messages occuring by using DOM
            // @see http://stackoverflow.com/a/6090728/2487859
            libxml_use_internal_errors(true);

            // DOMDocument::loadHTML will treat your string as being in ISO-8859-1 unless you tell it otherwise.
            // @see http://stackoverflow.com/a/8218649/2487859
            $oDom->loadHTML(
                mb_encode_numericentity(
                    $aToolbar['sRendered'],
                    [0x80, 0x10FFFF, 0, ~0],
                    'UTF-8'
                )
            );
            libxml_clear_errors();

            // add toolbar tag as a placeholder before body closing tag
            $oNode = $oDom->createElement($sToolBarVarName);
            $oBody = $oDom->getElementsByTagName('body');

            foreach ($oBody as $oItem)
            {
                $oItem->appendChild($oNode);
            }

            $sHtml = $oDom->saveHTML();

            // render the toolbar
            $sInfoToolRendered = $oView->fetch('string:' . $sInfoToolSmarty);

            // replace toolbar tag placeholder with rendered toolbar
            $sHtml = str_replace('<' . $sToolBarVarName . '></' . $sToolBarVarName . '>', $sInfoToolRendered, $sHtml);
        }

        // new output, now including toolbar
        echo $sHtml;
    }

    /**
     * collects all Info for being displayed by the Toolbar
     * @param \Smarty $oView
     * @return array
     * @throws \ReflectionException
     * @throws \Exception
     */
    protected function collectInfo(Smarty $oView) : array
    {
        $aToolbar = array ();
        $aGetEnv = getenv();
        $aConstants = get_defined_constants (true);
        $aRegistry = Registry::getStorageArray();
        $a_MVC_SESSION_OPTIONS = Config::get_MVC_SESSION_OPTIONS();

        $_POST = ($_POST ?? []);
        ksort($aConstants['user'], SORT_STRING|SORT_FLAG_CASE);
        ksort($aGetEnv, SORT_STRING|SORT_FLAG_CASE);
        ksort($_SERVER, SORT_STRING|SORT_FLAG_CASE);
        ksort($_REQUEST, SORT_STRING|SORT_FLAG_CASE);
        ksort($_COOKIE, SORT_STRING|SORT_FLAG_CASE);
        ksort($_POST, SORT_STRING|SORT_FLAG_CASE);
        ksort($_GET, SORT_STRING|SORT_FLAG_CASE);
        ksort($_SESSION, SORT_STRING|SORT_FLAG_CASE);
        ksort($_ENV, SORT_STRING|SORT_FLAG_CASE);
        ksort($aRegistry, SORT_STRING|SORT_FLAG_CASE);
        ksort($a_MVC_SESSION_OPTIONS, SORT_STRING|SORT_FLAG_CASE);

        $aMethod = get_class_methods('MVC\Config');
        $aTmp = array();

        foreach ($aMethod as $sMethod)
        {
            if (true === str_starts_with($sMethod, 'get'))
            {
                $sTmpVar = str_replace('get_', '', $sMethod);
                $aTmp['sVar'] = $sTmpVar;

                if (in_array($sTmpVar, array('MVC_ROUTING', 'MVC_MODULE_PRIMARY_VIEW')))
                {
                    $aTmp['mResult'] = '⚠ (would be too large to dump here)';
                }
                else
                {
                    $aTmp['mResult'] = Config::$sMethod();
                }

                $aTmp['sMethod'] = 'Config::' . $sMethod . '()';
                $aToolbar['aConfig'][$sTmpVar] = $aTmp;
            }
        }

        $aToolbar['sPHP'] = phpversion ();
        $aToolbar['sOS'] = PHP_OS;
        $aToolbar['sUniqueId'] = Config::get_MVC_UNIQUE_ID();
        $aToolbar['sMyMvcVersion'] = Config::get_MVC_VERSION();
        $aToolbar['sMyMVCCore'] = self::buildMarkupListTree(Config::get_MVC_CORE());
        $aToolbar['sEnv'] = getenv('MVC_ENV');
        $aToolbar['aEnvGetenv'] = self::buildMarkupListTree($aGetEnv);
        $aToolbar['aEnvEnv'] = self::buildMarkupListTree($_ENV);
        $aToolbar['sEnvOfRequest'] = php_sapi_name();
        $aToolbar['aGet'] = self::buildMarkupListTree($_GET);
        $aToolbar['aPost'] = self::buildMarkupListTree($_POST);
        $aToolbar['aCookie'] = self::buildMarkupListTree($_COOKIE);
        $aToolbar['aRequest'] = self::buildMarkupListTree($_REQUEST);
        $aToolbar['session_id'] = Session::is()->getSessionId();
        $aToolbar['aSessionSettings'] = array(
            'MVC_SESSION_ENABLE' => Config::get_MVC_SESSION_ENABLE(),
            'MVC_SESSION_PATH' => Config::get_MVC_SESSION_PATH(),
            'MVC_SESSION_OPTIONS' => self::buildMarkupListTree($a_MVC_SESSION_OPTIONS),
            'oSession' => Session::is(),
        );
        $aToolbar['aSessionKeyValues'] = self::buildMarkupListTree(Session::is()->getAll());
        $aToolbar['aSessionFiles'] = self::buildMarkupListTree(
            preg_grep('/^([^.])/', scandir($a_MVC_SESSION_OPTIONS['save_path']))
        );
        $aToolbar['aSessionRules']['aEnableSessionForController'] = (false === empty(Config::MODULE()['SESSION']['aEnableSessionForController']))
            ? self::buildMarkupListTree(Config::MODULE()['SESSION']['aEnableSessionForController'])
            : 'none'
        ;
        $aToolbar['aSessionRules']['aDisableSessionForController'] = (false === empty(Config::MODULE()['SESSION']['aDisableSessionForController']))
            ? self::buildMarkupListTree(Config::MODULE()['SESSION']['aDisableSessionForController'])
            : 'none'
        ;

        $aToolbar['aSmartyTemplateVars'] = $oView->getTemplateVars();
        $aToolbar['sSmartyTemplateVars'] = self::buildMarkupListTree($oView->getTemplateVars());
        $aToolbar['aConstant'] = self::buildMarkupListTree($aConstants['user']);
        $aToolbar['aServer'] = self::buildMarkupListTree($_SERVER);
        $aToolbar['sPathParam'] = self::buildMarkupListTree(Request::in()->get_pathParamArray());
        $aToolbar['aPathParam'] = Request::in()->get_pathParamArray();
        $aToolbar['aEvent'] = Config::get_MVC_EVENT();
        $aToolbar['aEventBIND'] = self::buildMarkupListTree($aToolbar['aEvent']['BIND']);
        $aToolbar['aEventBINDNAME'] = self::buildMarkupListTree(Event::$aEvent);
        $aToolbar['aEventRUN'] = self::buildMarkupListTree($aToolbar['aEvent']['RUN']);

        $aToolbar['aEventDELETE'] = (false === empty(($aToolbar['aEvent']['DELETE'] ?? array()))) ? self::buildMarkupListTree($aToolbar['aEvent']['DELETE']) : array();
        $aToolbar['aRouting'] = array(
            'aRequest' => Request::in()->getPropertyArray(),
            'sModule' => Route::getCurrent()->get_module(),
            'sController' => Route::getCurrent()->get_class(),
            'sMethod' => Route::getCurrent()->get_requestMethod(),
            'aRoutingCurrent' => Route::getCurrent()->getPropertyArray(),
            'sRoutingCurrent' => self::buildMarkupListTree(Route::getCurrent()->getPropertyArray()),
            'aRoute' => self::buildMarkupListTree(array_keys(Route::$aRoute)),
        );

        $aToolbar['sRoutingPath'] = Request::in()->get_path();
        $aToolbar['sRoutingQuery'] = Request::in()->get_query(); # (isset(Request::in()->get_query())) ? Request::in()['query'] : '';

        $aToolbar['aPolicy']['aRule'] = self::buildMarkupListTree(Policy::getRules());
        $aPolicy = Policy::getRulesApplied();
        $aTmpPolicy = array();

        /** @var \MVC\DataType\DTArrayObject $oDTArrayObject */
        foreach ($aPolicy as $oDTArrayObject)
        {
            $aTmpPolicy[] = $oDTArrayObject->getDTKeyValueByKey('sPolicy')->get_sValue();
        }

        $aToolbar['aPolicy']['aApplied'] = self::buildMarkupListTree($aTmpPolicy);

        $aToolbar['sTemplate'] = $oView->sTemplate;
        $aToolbar['sTemplateContent'] = (null !== ($aToolbar['sTemplate'] ?? null) && true === is_file($oView->sTemplate)) ? file_get_contents ($aToolbar['sTemplate'], true) : '';
        $aToolbar['sTemplateContent'] = Strings::highlight_html($aToolbar['sTemplateContent']);
        $aToolbar['aFilesIncluded'] = get_required_files();
        $aToolbar['aMemory'] = array(
            'iRealMemoryUsage' => (memory_get_usage (true) / 1024)
            , 'dMemoryUsage' => (memory_get_usage () / 1024)
            , 'dMemoryPeakUsage' => (memory_get_peak_usage () / 1024)
        );
        $aToolbar['aRegistry'] = $aRegistry;
        $aToolbar['sRegistry'] = self::buildMarkupListTree($aToolbar['aRegistry']);
        $aToolbar['aCache'] = self::buildMarkupListTree($this->getCaches());
        $aToolbar['aError'] = Error::get(bConvertToArray: false);
        $aToolbar['aModuleCurrentConfig'] = self::buildMarkupListTree(Config::MODULE());
        $aToolbar['sConstructionTime'] = Debug::constructionTime();

        return $aToolbar;
    }

    /**
     * @param mixed $aData
     * @param array $aConfig
     * @return string
     */
    protected static function buildMarkupListTree(mixed $aData, array $aConfig = array()) : string
    {
        return Strings::ulli(
            $aData
        );
    }

    /**
     * get cachefiles
     * @return array
     * @throws \ReflectionException
     */
    protected function getCaches() : array
    {
        $aCache = array ();
        $oObjects = new RecursiveIteratorIterator (
            new RecursiveDirectoryIterator (
                Config::get_MVC_CACHE_DIR(),
                0
            ),
            RecursiveIteratorIterator::SELF_FIRST,
            0
        );

        foreach ($oObjects as $sName => $oObject)
        {
            $sTmp = str_replace (Config::get_MVC_CACHE_DIR(), '', $sName);

            if (false == in_array(basename($sName), array('.', '..')))
            {
                $aCache[] = $sTmp;
            }
        }

        return $aCache;
    }
}