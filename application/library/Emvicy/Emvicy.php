<?php

namespace Emvicy;

use MVC\Config;
use MVC\Convert;
use MVC\Debug;
use MVC\Route;
use MVC\Strings;

#------------------------------------

class Emvicy
{
    /**
     * @return void
     */
    public static function init()
    {
        self::argToGet();
        $sCmd1 = current(array_keys($_GET));

        if (method_exists('\Emvicy\Emvicy', $sCmd1))
        {
            self::$sCmd1();
            exit();
        }

        self::help();
    }

    /**
     * @param string $sCmd
     * @param bool   $bEcho
     * @return string
     */
    public static function shellExecute(string $sCmd = '', bool $bEcho = false)
    {
        if (true === $bEcho)
        {
            echo $sCmd;
            nl();
        }

        $sResult = trim((string) shell_exec($sCmd));

        if (true === $bEcho)
        {
            echo $sResult;
            nl();
        }

        return $sResult;
    }

    /**
     * @return void
     */
    protected static function argToGet()
    {
        array_shift($GLOBALS['argv']);
        parse_str(
            implode(
                '&',
                str_replace(':', '=', $GLOBALS['argv'])
            ),
            $_GET
        );
    }

    /**
     * @return void
     */
    public static function help()
    {
        $sHelpFile = realpath(__DIR__) . '/doc/help.txt';
        echo file_get_contents($sHelpFile);
    }

    /**
     * @return bool
     */
    public static function get_force()
    {
        $sForce = substr(strtolower(get($_GET['force'], '')), 0, 1);

        if (true === in_array($sForce, array('1','y','j')))
        {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function get_primary()
    {
        $sPrimary = substr(strtolower(get($_GET['primary'], 'yes')), 0, 1);

        if (true === in_array($sPrimary, array('0','n')))
        {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public static function get_module()
    {
        $sModule = get($_GET['module'], '');
        $sModule = ucfirst(strtolower(preg_replace("/[^[:alpha:]]/ui", '', $sModule)));

        return $sModule;
    }

    /**
     * @param int $iLength
     * @return string
     */
    public static function get_stdin(int $iLength = 10)
    {
        return trim(fread(STDIN, $iLength));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearcache()
    {
        $sDir = Config::get_MVC_CACHE_DIR() . '/*';
        $aPath = array_filter((array) glob($sDir));

        foreach ($aPath as $sPath)
        {
            if (true === is_file($sPath))
            {
                unlink($sPath);
            }
            elseif (true === is_dir($sPath))
            {
                $aSubFile = glob($sPath . '/{,.}[!.,!..]*', GLOB_MARK|GLOB_BRACE);
                array_map('unlink', $aSubFile);
                rmdir($sPath);
            }
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cc()
    {
        self::clearcache();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearlog()
    {
        $sDir = Config::get_MVC_LOG_FILE_DIR() . '*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cl()
    {
        self::clearlog();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearsession()
    {
        $sDir = Config::get_MVC_SESSION_PATH() . '/*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cs()
    {
        self::clearsession();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function cleartemp()
    {
        $sDir = Config::get_MVC_SMARTY_TEMPLATE_CACHE_DIR(). '/*';
        array_map('unlink', array_filter((array) glob($sDir)));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function ct()
    {
        self::cleartemp();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function clearall()
    {
        self::clearcache();
        self::clearlog();
        self::clearsession();
        self::cleartemp();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function ca()
    {
        self::clearall();
    }

    /**
     * @param bool|null $bForce
     * @param bool|null $bPrimary
     * @param string    $sModule
     * @return false|void
     * @throws \ReflectionException
     */
    public static function create(bool $bForce = null, bool $bPrimary = null, string $sModule = '')
    {
        $bForce = (false === isset($bForce)) ? self::get_force() : $bForce;
        $sModule = ucfirst(trim((true === empty($sModule)) ? self::get_module() : $sModule));
        $bPrimary = (false === isset($bPrimary)) ? self::get_primary() : $bPrimary;

        if (true === empty($sModule))
        {
            return false;
        }

        echo str_pad('Module to be created:', 30, ' ') . $sModule;
        nl();
        echo str_pad('Should be a primary module:', 30, ' ') . Convert::boolToString($bPrimary);
        nl();

        if (false === $bForce)
        {
            echo "Accept: (y)/n";
            nl();
            $sStdin = strtolower(self::get_stdin(1));

            echo str_pad('Input:', 30, ' ') . $sStdin;
            nl();

            if ($sStdin !== '' && $sStdin !== 'y')
            {
                echo 'Abort.';
                nl();
                return false;
            }
        }

        echo 'creating...';
        nl();

        $oInstall = \Emvicy\Install::run(
            $sModule,
            $GLOBALS['aConfig'],
            $bPrimary
        );
    }

    /**
     * @return void
     */
    public static function c()
    {
        self::create();
    }

    /**
     * php emvicy serve
     * @return void
     * @throws \ReflectionException
     */
    public static function serve()
    {
        $sCmd = PHP_BINARY . " -S " . Config::get_MVC_PHP_SERVER() . " -t " . \MVC\Config::get_MVC_WEB_ROOT() . '/public/';
        echo $sCmd;
        hr();
        self::shellExecute($sCmd);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function s()
    {
        self::serve();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function lint(string $sModule = '')
    {
        $sPath = \MVC\Config::get_MVC_BASE_PATH();

        if (false === empty($sModule))
        {
            $sPath = \MVC\Config::get_MVC_MODULES_DIR() . '/' . $sModule;
        }
        if (false === empty(self::get_module()))
        {
            $sPath = \MVC\Config::get_MVC_MODULES_DIR() . '/' . self::get_module();
        }

        if (false === file_exists($sPath))
        {
            echo 'file does not exist: `' . $sPath . '`' . "\n";
            exit();
        }

        $sCmd = whereis('find') . ' ' . $sPath . ' -type f -name "*.php" '
            . ' -exec ' . PHP_BINARY . ' -l {} \; 2>&1 '
            . '| (! ' . whereis('grep') . ' -v "errors detected")';
        $sResult = self::shellExecute($sCmd, false);
        $aMessage = preg_split("@\n@", $sResult, -1, PREG_SPLIT_NO_EMPTY);

        if (true === empty(get($sResult, '')))
        {
            self::response(true);
        }
        else
        {
            self::response(false, $aMessage);
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function l()
    {
        self::lint();
    }

    /**
     * @param bool   $bSuccess
     * @param array  $aMessage
     * @return void
     */
    public static function response(bool $bSuccess = false, array $aMessage = array())
    {
        $aResponse = array(
            'bSuccess' => $bSuccess,
            'aMessage' => $aMessage,
        );

        echo json_encode($aResponse);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function update()
    {
        $xGit = whereis('git');

        UPDATE_FRAMEWORK: {

            if (false === empty($xGit))
            {
                $sCmd = $xGit . ' pull';
                self::shellExecute($sCmd, true);
            }

            $sCmd = 'cd ' . Config::get_MVC_APPLICATION_PATH() . '; ' . PHP_BINARY . ' composer.phar update;';
            self::shellExecute($sCmd, true);
        }

        UPDATE_MODULES_VENDOR_LIBS: {
            $aModule = preg_grep('/^([^.])/', scandir($GLOBALS['aConfig']['MVC_MODULES_DIR']));

            foreach ($aModule as $sModule)
            {
                $sModuleConfigPathAbs = $GLOBALS['aConfig']['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/' . $sModule;
                $sComposerJson = $sModuleConfigPathAbs . '/composer.json';

                if (false === empty($xGit))
                {
                    $sCmd = 'cd ' . $GLOBALS['aConfig']['MVC_MODULES_DIR'] . '/' . $sModule . '; ' . $xGit . ' pull';
                    self::shellExecute($sCmd, true);
                }

                if (true === file_exists($sComposerJson))
                {
                    $sCmd = 'cd ' . $sModuleConfigPathAbs . '; ' . PHP_BINARY . ' ' . Config::get_MVC_APPLICATION_PATH() . '/composer.phar update;';
                    self::shellExecute($sCmd, true);
                }
            }
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function up()
    {
        self::update();
    }

    /**
     * @example php emvicy log id=2023070711413964a7ddd36254a nl=true
     * @required grep, awk, sed
     * @param string $sLogId
     * @param bool   $bNewline
     * @return void
     * @throws \ReflectionException
     */
    public static function log(string $sLogId = '', bool $bNewline = true)
    {
        if (true === empty($sLogId))
        {
            $sLogId = (false === empty(get($_GET['id'])))? get($_GET['id']) : Config::get_MVC_UNIQUE_ID();
        }

        if (true === empty($bNewline))
        {
            $bNewline = (false === empty(get($_GET['nl'])))
                ? (boolean) get($_GET['nl'])
                : false
            ;
        }

        // sort with awk on 8. field (Emvicy Log increment number)
        $sCmd = "cd " . Config::get_MVC_LOG_FILE_DIR() . "; "
                . whereis('grep') .  " " . $sLogId . " *.log "
                . "| " . whereis('awk') . " '{ print $0 | \"" . whereis('sort') . " -nk8\"}'";

        // replace string \n in output by a real linebreak
        (true === $bNewline) ? $sCmd.= " | " . whereis('sed') . " -E 's/" . '\\\n' . "/" . '\n' . "/g'" : false;

        hr();
        echo $sCmd;
        hr();
        $sLog = trim((string) (shell_exec($sCmd)));

        nl();
        echo $sLog;
        nl(2);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function version()
    {
        echo Config::get_MVC_VERSION();
        nl();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function v()
    {
        self::version();
    }

    /**
     * @return void
     */
    public static function md(bool $bReturn = false)
    {
        self::modules($bReturn);
    }

    /**
     * @return void
     */
    public static function modules(bool $bReturn = false)
    {
        $aModuleSet = get($GLOBALS['aConfig']['MVC_MODULE_SET'], array());

        if (true === $bReturn)
        {
            return $aModuleSet;
        }

        echo json_encode($aModuleSet) . "\n\n";
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function dt()
    {
        self::datatype();
    }

    /**
     * @param string $sParamModule
     * @return void
     * @throws \ReflectionException
     */
    public static function datatype(string $sParamModule = '')
    {
        $sModuleRequested = (false === empty($sParamModule)) ? $sParamModule : get($_GET['module']);

        \MVC\Cache::init(\MVC\Config::get_MVC_CACHE_CONFIG());
        \MVC\Cache::autoDeleteCache('DataType', 0);

        foreach ($GLOBALS['aConfig']['MVC_MODULE_SET'] as $sType => $aModule)
        {
            foreach ($aModule as $sModule)
            {
                // skip if a certain module was requested
                if (false === is_null($sModuleRequested) && $sModule !== $sModuleRequested)
                {
                    continue;
                }

                $aDataTypeConfig = get($GLOBALS['aConfig']['MODULE'][$sModule]['DATATYPE']);

                if (false === is_null($aDataTypeConfig))
                {
                    echo 'generating Datatype Classes for module: `' . $sModule . '`, ';
                    echo 'directory: `' . get($aDataTypeConfig['dir']) . '` ... ';
                    \MVC\Generator\DataType::create()->initConfigArray($aDataTypeConfig);
                    echo "done ✔\n";
                }
            }
        }
    }

    /**
     * @example php emvicy test -c modules/Foo/Test/
     * @param string $sModule
     * @return void
     * @throws \ReflectionException
     */
    public static function test(string $sModule = '')
    {
        array_shift($GLOBALS['argv']);
        $sArg = (true === empty($sModule)) ? implode(' ', $GLOBALS['argv']) : $sModule;
        $sCmd = Config::get_MVC_BIN_PHP_BINARY() . ' ' . Config::get_MVC_APPLICATION_PATH() . "/vendor/bin/phpunit" . ' ' . $sArg;
        self::shellExecute($sCmd, true);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function rt()
    {
        self::routes();
    }

    /**
     * @param string $sOption
     * @return void
     * @throws \ReflectionException
     */
    public static function routes(string $sOption = '')
    {
        array_shift($GLOBALS['argv']);
        $sArg = (false === empty($sOption)) ? $sOption : implode(' ', $GLOBALS['argv']);

        Route::init();
        $aIndex = Route::$aMethod;
        $iMaxLengthRoute = max(array_map('strlen', Route::getIndices())) + 6;
        $iHrLength = ($iMaxLengthRoute + 120);

        if ('list' === $sArg)
        {
            hr('=', $iHrLength);
            echo str_pad('Method', 10, ' ')
                . str_pad('| Methods assigned', 30, ' ')
                . str_pad('| Route', $iMaxLengthRoute, ' ')
                . str_pad('| Target', 50, ' ')
                . str_pad('| Tag', 30, ' ')
            ;
            hr('=', $iHrLength);
            foreach ($aIndex as $sMethod => $aRoute)
            {
                foreach ($aRoute as $sRoute)
                {
                    echo str_pad(strtoupper($sMethod), 10, ' ')
                        . str_pad('| ' . implode(',' , Route::$aRoute[$sRoute]->get_methodsAssigned()), 30, ' ')
                        . str_pad('| ' . Strings::cutOff($sRoute, ($iMaxLengthRoute - 6)), $iMaxLengthRoute, ' ')
                        . str_pad('| ' . Route::$aRoute[$sRoute]->get_class() . '::' . Route::$aRoute[$sRoute]->get_m(), 50, ' ')
                        . str_pad('| ' . Strings::cutOff(Route::$aRoute[$sRoute]->get_tag(), 24, '[..]'), 30, ' ')
                    ;
                    hr('-', $iHrLength, "\033[90m");
                }
            }
        }
        elseif ('json' === $sArg)
        {
            echo json_encode($aIndex);
        }
        else
        {
            Debug::varExport($aIndex);
        }
        nl();
    }
}