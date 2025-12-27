<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * instantiate MyMVCInstaller
 */

use MVC\Config;

/**
 * MyMVCInstaller
 */
class MyMVCInstaller
{
    /**
     * @var self|null
     */
    protected static $_oInstance = null;

    /**
     * @var array
     */
    protected $_aConfig;

    /**
     * @var array
     */
	protected $_aBootstrapperFileInfo;

    /**
     * @var bool
     */
	protected static $_bOutputStarted = false;

    /**
     * @param array $aConfig
     * @throws \ReflectionException
     */
    protected function __construct (array $aConfig = array())
	{
        $this->_aConfig = $aConfig;
        $sCacheFunctionFile = $aConfig['MVC_CACHE_DIR'] . '/.' . __METHOD__;

        if (false === file_exists($sCacheFunctionFile))
        {
            $this->setupDirsAndFiles($aConfig);         # once
            $this->checkForPHPExtensions($aConfig);     # once and later recurring
            $this->createLogrotateFiles($aConfig);      # once
            $this->installModuleLibraries($aConfig);    # once

            touch($sCacheFunctionFile);
        }

        // do not check if source of request is emvicy tool
        if ('cli.emvicy' !== self::getEnvironmentOfRequest())
        {
            $this->checkOnModulesInstalled($aConfig);
        }

        if (true === self::$_bOutputStarted)
        {
            $this->_text("\n<hr /><dd><b><i class='fa fa-check text-success'></i></b> Installation completed.\n</dd>");
            ('cli' !== php_sapi_name()) ? $this->_text("<dd>Page will auto-reload in 5 seconds...</dd>") : '';
            $sMarkup = '<script>reload();</script>';
            echo ('cli' !== php_sapi_name()) ? $sMarkup : '';
            exit();
        }
	}

    /**
     * @param array $aConfig
     * @return \MyMVCInstaller|\Singleton|self|null
     * @throws \ReflectionException
     */
    public static function create(array $aConfig = array())
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self($aConfig);
        }

        return self::$_oInstance;
    }

    /**
     * @return string
     */
    public static function getEnvironmentOfRequest()
    {
        $bEmvicy = (bool) getenv('emvicy');
        $bCli = $GLOBALS['aConfig']['MVC_CLI'];

        // is webserver Request
        if (false === $bEmvicy && false === $bCli)
        {
            return 'server.web';
        }

        // is cli-server request
        if (true === $bEmvicy && false === $bCli)
        {
            return 'server.cli';
        }

        // is cli request
        if (false === $bEmvicy && true === $bCli)
        {
            return 'cli';
        }

        // is emvicy request
        if (true === $bEmvicy && true === $bCli)
        {
            return 'cli.emvicy';
        }

        return '';
    }

    /**
     * @return void
     */
    protected function checkOnModulesInstalled(array $aConfig = array())
    {
        // check on any module
        $aModule = glob($aConfig['MVC_MODULES_DIR'] . '/*', GLOB_ONLYDIR);

        // check on primary module
        $aModulePrimary = glob($aConfig['MVC_MODULES_DIR'] . '/*' . $aConfig['MVC_MODULE_PRIMARY_ESSENTIAL']);

        if (true === empty($aModule) || true === empty($aModulePrimary))
        {
            $this->prepareForOutput();
            $this->_text("\n<br><span class='text-info'><b>🛈</b> You need to install at least one Module as primary to be able to work.</span>");
            $this->_text("\n<hr><i><u>Example</u>: create the primary module 'Foo'</i>");
            $this->_text("\n\t<br><pre class='bg-black text-white padding10 rounded-1'>cd " . $aConfig['MVC_BASE_PATH'] . "; \\\n" . PHP_BINDIR . "/php emvicy module:add Foo primary</pre>\n");
            $this->_text("Afterwards, reload this page");
            exit();
        }
    }

    /**
     * @return bool
     */
	protected function flushOutput()
	{
		error_reporting (E_ALL);
		set_time_limit (0);
		ini_set('implicit_flush', 1);
		('cli' !== php_sapi_name()) ? ob_end_flush () : false;
		ob_implicit_flush ();

		return true;
	}

    /**
     * @param array $aConfig
     * @return string
     */
	protected function checkPhpExtension(array $aConfig = array())
	{
		$aExt = get_loaded_extensions();
		$aExtMissing = array();
		$sMsg = '';

		foreach ($aConfig['MVC_CORE']['phpExtensionsRequired'] as $sExt)
		{
			if (!in_array ($sExt, $aExt))
			{
				$aExtMissing[] = $sExt;
			}
		}

		if (false === empty($aExtMissing))
		{
			$sMsg = "\nPHP extensions are missing on your system: \n";
            $sMsg.= '<ul>';

			foreach ($aExtMissing as $sMissing)
            {
                $sMsg.= '<li>' . $sMissing . "</li>\n";
            }

			$sMsg.='</ul>' . "\n";
            $sMsg.= "Required Extensions: \n";
            $sMsg.= implode(', ', $aConfig['MVC_CORE']['phpExtensionsRequired']);
		}

		return $sMsg;
	}

    /**
     * @param array $aConfig
     * @return string
     */
	protected function checkFunction(array $aConfig = array())
	{
        $aFuncMissing = array();
        $sMsg = '';

        foreach ($aConfig['MVC_CORE']['phpFunctionsRequired'] as $sExt)
        {
            if (false === function_exists ($sExt))
            {
                $aFuncMissing[] = $sExt;
            }
        }

        if (false === empty($aFuncMissing))
        {
            $sMsg = "\nPHP functions are missing on your system: \n";
            $sMsg.= '<ul>';

            foreach ($aFuncMissing as $sMissing)
            {
                $sMsg.= '<li>' . $sMissing . "</li>\n";
            }

            $sMsg.='</ul>' . "\n";
            $sMsg.= "Required Extensions: \n";
            $sMsg.= implode(', ', $aConfig['MVC_CORE']['phpExtensionsRequired']);
        }

        return $sMsg;
	}

    /**
     * @return array
     */
	protected function getBootstrapperFileInfo()
	{
		$sFilename = $this->_aConfig['MVC_PUBLIC_PATH'] . '/index.php';
		$aUser = posix_getpwuid(fileowner($sFilename));
		$aGroup = posix_getgrgid(filegroup($sFilename));

		return array(
			'aUser' => $aUser,
			'aGroup' => $aGroup,
		);
	}

    /**
     * @param array $aConfig
     * @return bool
     */
	protected function setupDirsAndFiles(array $aConfig = array()) : bool
	{
        $bSuccess = true;
        $sCacheFunctionFile = $aConfig['MVC_CACHE_DIR'] . '/.' . __METHOD__;

        if (true === file_exists($sCacheFunctionFile))
        {
            return $bSuccess;
        }

        $aDir = array(
            $aConfig['MVC_CACHE_DIR'],
            $aConfig['MVC_SESSION_PATH'],
            $aConfig['MVC_SMARTY_TEMPLATE_CACHE_DIR'],
            $aConfig['MVC_CONFIG_DIR'],
            $aConfig['MVC_LOG_FILE_DIR'],
        );

        foreach ($aDir as $sDir)
        {
            if (false === file_exists($sDir))
            {
                if (false === mkdir ($sDir))
                {
                    $bSuccess = false;
                }
            }
        }

        if (true === $bSuccess)
        {
            touch($sCacheFunctionFile);
        }

        return $bSuccess;
    }

    /**
     * @param array $aConfig
     * @return true
     * @throws \ReflectionException
     */
    protected function createLogrotateFiles(array $aConfig = array())
    {
        if (true === file_exists($aConfig['MVC_APPLICATION_PATH'] . '/logrotate.conf') && true === file_exists($aConfig['MVC_APPLICATION_PATH'] . '/logrotate.sh'))
        {
            return true;
        }

        $aUser = posix_getpwuid(fileowner($aConfig['MVC_LOG_FILE_DIR']));
        $aGroup = posix_getgrgid(filegroup($aConfig['MVC_LOG_FILE_DIR']));
        $sLogrotate = "\"" . $aConfig['MVC_LOG_FILE_DIR'] . "*.log\"
{
    rotate 2
    daily
    su " . $aUser['name'] . " " . $aGroup['name'] . "
    create 640 " . $aUser['name'] . " " . $aGroup['name'] . "
    compress
    missingok
    notifempty
    copytruncate
    size=250k
}";
        file_put_contents($aConfig['MVC_APPLICATION_PATH'] . '/logrotate.conf', $sLogrotate);
        $sCmdLogrotate = '#!' . whereis('bash') . "\n" . whereis('logrotate') . ' -v -s /tmp/' . uniqid() . ' ' . $aConfig['MVC_APPLICATION_PATH'] . '/logrotate.conf';
        file_put_contents($aConfig['MVC_APPLICATION_PATH'] . '/logrotate.sh', $sCmdLogrotate);
        chmod($aConfig['MVC_APPLICATION_PATH'] . '/logrotate.sh',0744);

        return true;
    }

    /**
     * @return void
     */
    protected function placeMarkup()
    {
        $sMarkup = '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><title>Foo</title><link href="/Emvicy/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"><link href="/Emvicy/assets/fontawesome-free-6.7.2-web/css/all.min.css" rel="stylesheet" type="text/css"><link href="/Emvicy/styles/Emvicy.min.css" rel="stylesheet" type="text/css"><style>body {padding-top: 7rem;/* Move down content because of fixed navbar */}</style></head>'
                   . '<body><a name="top"></a>'
                   . '<div class="container">'
                   . '<div class="header shadow"><h3 class="text-muted bg-white padding20"><img src="/android-chrome-192x192.png" width="50" style="margin: 0;border: none;">Emvicy</h3></div><br>'
                   . '<div id="jumboHomepage" class="bg-white shadow padding20">'
                   . '<noscript><p>please activate Javascript<br />then run this page again.</p></noscript>'
                   . '</div><hr>'
                   . '<footer class="footer"><p>documentation: <a href="https://emvicy.com/" target="_blank">emvicy.com</a></p></footer>'
                   . '</div>'
                   . '<script>function text(sTxt){var sInnerHTML = document.getElementById("jumboHomepage").innerHTML; document.getElementById("jumboHomepage").innerHTML = sInnerHTML + sTxt};function reload(){setTimeout(function(){window.location.reload(1);}, 5000);}</script>'
                   . '<script src="/Emvicy/assets/jquery-3.7.1/jquery-3.7.1.min.js" type="text/javascript"></script><script src="/Emvicy/assets/jquery-cookie-1.4.1/jquery.cookie.min.js" type="text/javascript"></script><script src="/Emvicy/assets/bootstrap-5.3.3-dist/js/bootstrap.min.js" type="text/javascript"></script><script src="/Emvicy/scripts/cookieConsent.min.js" type="text/javascript"></script></body></html>';

        echo ('cli' !== php_sapi_name()) ? $sMarkup : '';
    }

    /**
     * @param string $sInstallLock
     * @return bool
     */
    protected function writeInstallLock(string $sInstallLock = '')
    {
        if ('' !== $sInstallLock && false === file_exists($sInstallLock))
        {
            return touch($sInstallLock);
        }

        return false;
    }

    /**
     * @param string $sInstallLock
     * @return bool
     */
    protected function removeInstallLock(string $sInstallLock = '')
    {
        if ('' !== $sInstallLock && true === file_exists($sInstallLock))
        {
            return unlink($sInstallLock);
        }

        return false;
    }

    /**
     * @param array $aConfig
     * @return void
     */
    protected function checkForPHPExtensions(array $aConfig = array())
    {
        $sPhpExtensionMissing = $this->checkPhpExtension($aConfig);
        $sPhpFunctionMissing = $this->checkFunction($aConfig);

        if ('' !== $sPhpExtensionMissing)
        {
            $this->placeMarkup();
            $this->_text('<h2>setup checking</h2>');
            $this->_text($sPhpExtensionMissing);
            exit();
        }

        if ('' !== $sPhpFunctionMissing)
        {
            $this->placeMarkup();
            $this->_text('<h2>setup checking</h2>');
            $this->_text($sPhpFunctionMissing);
            exit();
        }
    }

    /**
     * @param string $sInstallLock
     * @return void
     */
    protected function prepareForOutput(string $sInstallLock = '')
    {
        if (false === self::$_bOutputStarted)
        {
            $this->placeMarkup();
            $this->flushOutput();
            $this->_aBootstrapperFileInfo = $this->getBootstrapperFileInfo();
            $this->_text('<h2>setup checking</h2>');

            if ('' !== $sInstallLock)
            {
                // abort if installer is still running
                if (file_exists($sInstallLock))
                {
                    $this->_text('<dd>The Installer seems to be running in the background. Please wait a few minutes before reloading this page.</dd>');
                    exit();
                }

                // write installer lock file
                $this->writeInstallLock($sInstallLock);
            }

            $this->_text('<dd>&bull; MVC_ENV is: <code>' . $this->_aConfig['MVC_ENV'] . '</code></dd>');
            $this->_text('<dd>&bull; User/Group from <code>/public/index.php</code>: <code>'
                . $this->_aBootstrapperFileInfo['aUser']['name']
                . '</code>(' . $this->_aBootstrapperFileInfo['aUser']['uid'] . ') / <code>'
                . $this->_aBootstrapperFileInfo['aGroup']['name']
                . '</code>(' . $this->_aBootstrapperFileInfo['aGroup']['gid'] . ')</dd>');

            // add composer home if missing
            if (false === getenv ('COMPOSER_HOME'))
            {
                putenv ('COMPOSER_HOME=' . $this->_aConfig['MVC_APPLICATION_PATH'] . '/.composer');
            }

            self::$_bOutputStarted = true;
        }
    }

    /**
     * @param string $sComposerDir
     * @return int
     */
	protected function installVendor(string $sComposerDir = '')
	{
        $iPid = 0;

        if ('' === $sComposerDir)
        {
            return $iPid;
        }

        $sComposerJsonFile = $sComposerDir . '/composer.json';
        $sInstallLock = $sComposerDir . '/INSTALLER_RUNNING.sh';
        $sComposerLockFile = $sComposerDir . '/composer.lock';
        $sVendorFolder = $sComposerDir . '/vendor';

		if (
            file_exists ($sComposerJsonFile) &&
            file_exists ($sComposerLockFile) &&
            file_exists ($sVendorFolder)
        )
		{
			$this->removeInstallLock($sInstallLock);

			return $iPid;
		}

        $aComposerJson = json_decode(file_get_contents($sComposerJsonFile), true);

        if (true === empty($aComposerJson))
        {
            return $iPid;
        }

        $this->prepareForOutput($sInstallLock);

        // save runfile
        $sCmd = 'cd ' . $sComposerDir . '; '
                . PHP_BINDIR . '/php ' . $this->_aConfig['MVC_APPLICATION_PATH'] . '/composer.phar self-update; '
                . PHP_BINDIR . '/php ' . $this->_aConfig['MVC_APPLICATION_PATH'] . '/composer.phar --working-dir="' . $sComposerDir . '" install --prefer-dist; '
                . $this->_aConfig['MVC_BIN_REMOVE'] . ' ' . $sInstallLock . ';';

        file_put_contents($sInstallLock, "#!/bin/bash\n" . $sCmd);
        $iPid = $this->_runInBackground('/bin/bash ' . $sInstallLock);
        $this->_text('<dd>&bull; Installing required <kbd>Module libraries</kbd> via composer in Background with PID <code>' . $iPid . '</code>. Please wait.</dd>');

        while (true === $this->_isProcessRunning ($iPid))
        {
            $this->_flush ();
        }

        $this->removeInstallLock($sInstallLock);

        return $iPid;
	}

    /**
     * @param array $aConfig
     * @return void
     */
    protected function installModuleLibraries(array $aConfig = array())
    {
        $this->installVendor($aConfig['MVC_APPLICATION_PATH']);

        $sCmd = $aConfig['MVC_BIN_FIND'] . ' ' . $aConfig['MVC_MODULES_DIR'] . '/ -name "composer.json" -print | ' . $aConfig['MVC_BIN_GREP'] . ' -v vendor';
        $sResult = shell_exec($sCmd);
        $sFind = trim(($sResult ?? ''));
        $aFind = explode("\n", $sFind);

        foreach ($aFind as $sComposerJsonFile)
        {
            $sComposerDir = dirname($sComposerJsonFile);
            $this->installVendor($sComposerDir);
        }
    }

    /**
     * @param $sCommand
     * @return int
     */
	protected function _runInBackground(string $sCommand = '')
	{
		$iPid = (int) trim(shell_exec($sCommand . ' > /dev/null 2>/dev/null & echo $!'));

		return $iPid;
	}

    /**
     * @param int $iPid
     * @return bool
     */
	protected function _isProcessRunning(int $iPid = 0)
	{
	    if (0 === $iPid)
        {
            return false;
        }

		exec($this->_aConfig['MVC_BIN_PS'] . ' ' . $iPid, $iProcessState);
        $bIsRunning = (count ($iProcessState) >= 2);

		return $bIsRunning;
	}

    /**
     * @return void
     */
	protected function _flush()
	{
		$this->_text("<i class='fa fa-asterisk fa-spin text-primary'></i>");
		
		(ob_get_level() > 0) ? ob_flush() : false;		
		flush ();
		sleep (3);
	}

    /**
     * @param string $sText
     * @return void
     */
	protected function _text(string $sText = '')
	{
		if ('cli' === php_sapi_name())
		{
			$sText = strip_tags($sText);
			echo ('' === $sText) ? "." : html_entity_decode($sText) . "\n";
		}
		else
		{
            echo '<script>text("' . str_replace("\n", '<br>', trim($sText)) . '");</script>';
		}
	}
}

#-----------------------------

(true === isset($aConfig) && false === isset($GLOBALS['aConfig']))
    ? $GLOBALS['aConfig'] = $aConfig
    : false
;

//$oMyMVCInstaller = new MyMVCInstaller($GLOBALS['aConfig']);

MyMVCInstaller::create($GLOBALS['aConfig']);
