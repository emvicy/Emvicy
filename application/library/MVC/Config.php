<?php
/**
 * Config.php
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $MVC
 */

namespace MVC;


use phpDocumentor\Reflection\Types\Self_;

/**
 * Application
 */
class Config
{
    /**
     * @return bool
     */
    public static function get_MVC_LOG_AUTOLOADER(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_AUTOLOADER'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_AUTOLOADER(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_AUTOLOADER'] = $bVar;
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_CONTROLLER_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_CONTROLLER_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_DATATYPE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_DATATYPE_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_ETC_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_ETC_DIR'];
    }

    /**
     * @return \Closure
     */
    public static function get_MVC_ROUTING_FALLBACK() : \Closure
    {
        return $GLOBALS['aConfig']['MVC_ROUTING_FALLBACK'];
    }

    /**
     * @return string
     */
    public static function get_MVC_METHODNAME_PRECONSTRUCT(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_METHODNAME_PRECONSTRUCT'];
    }

    /**
     * @return string
     */
    public static function get_MVC_WEB_ROOT(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_WEB_ROOT'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BASE_PATH(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BASE_PATH'];
    }

    /**
     * @return string
     */
    public static function get_MVC_APPLICATION_PATH(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_APPLICATION_PATH'];
    }

    /**
     * @return string
     */
    public static function get_MVC_PUBLIC_PATH(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_PUBLIC_PATH'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_DEFAULT(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_ERROR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_ERROR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_WARNING(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_WARNING'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_NOTICE(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_NOTICE'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_POLICY(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_POLICY'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_EVENT(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_EVENT'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_EVENT_RUN(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_EVENT_RUN'];
    }

    /**
     * @return array
     */
    public static function get_MVC_LOG_DETAIL(): array
    {
        return (array) $GLOBALS['aConfig']['MVC_LOG_DETAIL'];
    }

    /**
     * @param array $aLogDetail
     * @return void
     */
    public static function set_MVC_LOG_DETAIL(array $aLogDetail = array()): void
    {
        $GLOBALS['aConfig']['MVC_LOG_DETAIL'] = $aLogDetail;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_FORCE_LINEBREAK(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_FORCE_LINEBREAK'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bForce
     * @return void
     */
    public static function set_MVC_LOG_FORCE_LINEBREAK(bool $bForce = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FORCE_LINEBREAK'] = $bForce;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_PROCESS(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_PROCESS'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_PROCESS(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_PROCESS'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_QUEUE(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_QUEUE'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_QUEUE(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_QUEUE'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_CRON(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_CRON'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_CRON(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_CRON'] = $bVar;
    }

    /**
     * @return string
     */
    public static function get_MVC_APPLICATION_INIT_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_APPLICATION_INIT_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_VIEW_TEMPLATE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_VIEW_TEMPLATE_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_LIBRARY(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LIBRARY'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULES_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULES_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_CONFIG_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_CONFIG_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_CACHE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_CACHE_DIR'];
    }

    /**
     * @param string $sCacheDir
     * @return void
     */
    public static function set_MVC_CACHE_DIR(string $sCacheDir = ''): void
    {
        $GLOBALS['aConfig']['MVC_CACHE_DIR'] = $sCacheDir;
    }

    /**
     * @return int
     */
    public static function get_MVC_SSL_PORT(): int
    {
        return (int) ($GLOBALS['aConfig']['MVC_SSL_PORT'] ?? 0);
    }

    /**
     * @return bool
     */
    public static function get_MVC_SECURE_REQUEST(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_SECURE_REQUEST'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @return string
     */
    public static function get_MVC_SESSION_NAMESPACE(): string
    {
        return (string) ($GLOBALS['aConfig']['MVC_SESSION_NAMESPACE'] ?? 'Emvicy');
    }

    /**
     * @param string $sNamespace
     * @return bool success
     * @throws \ReflectionException
     */
    public static function set_MVC_SESSION_NAMESPACE(string $sNamespace = ''): bool
    {
        $aDebugBacktrace = debug_backtrace(limit: 2);
        $sClass = ($aDebugBacktrace[1]['class'] ?? '');
        $sFunction = ($aDebugBacktrace[1]['function'] ?? '');

        if (true === empty($sClass) || true === empty($sFunction))
        {
            return false;
        }

        $sCaller = $sClass . '::' . $sFunction;

        if (false === ('MVC\\Session::setNamespace' === $sCaller))
        {
            Session::is()
                ->setNamespace($sNamespace);
        }

        $GLOBALS['aConfig']['MVC_SESSION_NAMESPACE'] = $sNamespace;

        return true;
    }

    /**
     * @return string
     */
    public static function get_MVC_SESSION_PATH(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_SESSION_PATH'];
    }

    /**
     * @return array
     */
    public static function get_MVC_SESSION_OPTIONS(): array
    {
        return (array) $GLOBALS['aConfig']['MVC_SESSION_OPTIONS'];
    }

    /**
     * @return bool
     */
    public static function get_MVC_SESSION_ENABLE(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_SESSION_ENABLE'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bEnable
     * @return void
     */
    public static function set_MVC_SESSION_ENABLE(bool $bEnable = true): void
    {
        $GLOBALS['aConfig']['MVC_SESSION_ENABLE'] = $bEnable;
    }

    /**
     * @return bool
     */
    public static function get_MVC_CLI(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_CLI'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @return bool
     */
    public static function get_MVC_SMARTY_CACHE_STATUS(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_SMARTY_CACHE_STATUS'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @return string
     */
    public static function get_MVC_SMARTY_CACHE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_SMARTY_CACHE_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_SMARTY_TEMPLATE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_SMARTY_TEMPLATE_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_SMARTY_TEMPLATE_DEFAULT(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_SMARTY_TEMPLATE_DEFAULT'];
    }

    /**
     * @return string
     */
    public static function get_MVC_SMARTY_TEMPLATE_CACHE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_SMARTY_TEMPLATE_CACHE_DIR'];
    }

    /**
     * @return array
     */
    public static function get_MVC_SMARTY_PLUGINS_DIR(): array
    {
        return (array) $GLOBALS['aConfig']['MVC_SMARTY_PLUGINS_DIR'];
    }

    /**
     * gets the policy rules from registry
     * @return array
     */
    public static function get_MVC_POLICY(): array
    {
        return (array) $GLOBALS['aConfig']['MVC_POLICY'];
    }

    /**
     * sets policy rules to registry
     * @param array $aPolicy
     * @return void
     */
    public static function set_MVC_POLICY(array $aPolicy = array()): void
    {
        $GLOBALS['aConfig']['MVC_POLICY'] = $aPolicy;
    }

    /**
     * @return array
     */
    public static function get_MVC_EVENT(): array
    {
        return (array) ($GLOBALS['aConfig']['MVC_EVENT'] ?? array());
    }

    /**
     * @param array $aMvcEvent
     * @return void
     */
    public static function set_MVC_EVENT(array $aMvcEvent = array()): void
    {
        $GLOBALS['aConfig']['MVC_EVENT'] = $aMvcEvent;
    }

    /**
     * @return string
     */
    public static function get_MVC_UNIQUE_ID(): string
    {
        return (string) ($GLOBALS['aConfig']['MVC_UNIQUE_ID'] ?? '---');
    }

    /**
     * @param string $sMvcUniqueId
     * @return void
     */
    public static function set_MVC_UNIQUE_ID(string $sMvcUniqueId = ''): void
    {
        $GLOBALS['aConfig']['MVC_UNIQUE_ID'] = $sMvcUniqueId;
    }

    /**
     * @return \MVC\Session|null
     */
    public static function get_MVC_SESSION(): Session|null
    {
        return ($GLOBALS['aConfig']['MVC_SESSION'] ?? null);
    }

    /**
     * @param \MVC\Session $oSession
     * @return void
     */
    public static function set_MVC_SESSION(Session $oSession): void
    {
        $GLOBALS['aConfig']['MVC_SESSION'] = $oSession;
    }

    /**
     * @return bool
     */
    public static function get_MVC_INFOTOOL_ENABLE(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_INFOTOOL_ENABLE'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_INFOTOOL_ENABLE(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_INFOTOOL_ENABLE'] = $bVar;
    }

    /**
     * @param string $sModule
     * @return array
     * @throws \ReflectionException
     */
    public static function MODULE(string $sModule = ''): array
    {
        if ('' === $sModule)
        {
            $sModule = self::get_MVC_MODULE_PRIMARY_NAME();
        }

        return (array) ($GLOBALS['aConfig']['MODULE'][$sModule] ?? array());
    }

    /**
     * @return array
     */
    public static function get_MVC_CORE(): array
    {
        return (array) $GLOBALS['aConfig']['MVC_CORE'];
    }

    /**
     * @return string
     */
    public static function get_MVC_ENV(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_ENV'];
    }

    /**
     * @return string
     */
    public static function get_MVC_VERSION(): string
    {
        return (string) ($GLOBALS['aConfig']['MVC_CORE']['version'] ?? '?');
    }

    /**
     * @return array
     */
    public static function get_MVC_CACHE_CONFIG(): array
    {
        return (array) $GLOBALS['aConfig']['MVC_CACHE_CONFIG'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_COMPOSER_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_COMPOSER_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_CONFIG_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_CONFIG_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_MODEL_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_MODEL_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_POLICY_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_POLICY_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_VIEW_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_VIEW_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_ETC_CONFIG_PRIMARY(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_ETC_CONFIG_PRIMARY'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR'];
    }

    /**
     * @return string
     */
    public static function get_MVC_MODULE_PRIMARY_NAME(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_NAME'];
    }

    /**
     * @param \MVC\View $oView
     * @return void
     */
    public static function set_MVC_MODULE_PRIMARY_VIEW(View $oView): void
    {
        Registry::set('MVC_MODULE_PRIMARY_VIEW', $oView);
        $GLOBALS['aConfig']['MVC_MODULE_PRIMARY_VIEW'] = $oView;
    }

    /**
     * @return \MVC\View|null
     * @throws \ReflectionException
     */
    public static function get_MVC_MODULE_PRIMARY_VIEW(): View|null
    {
        $oView = null;

        if (Registry::isRegistered('MVC_MODULE_PRIMARY_VIEW'))
        {
            /** @var \MVC\View $oView */
            $oView = Registry::get('MVC_MODULE_PRIMARY_VIEW');
        }

        return $oView;
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_REMOVE(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_REMOVE'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_FIND(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_FIND'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_GREP(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_GREP'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_MOVE(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_MOVE'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_XARGS(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_XARGS'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_SED(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_SED'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_PHP_BINARY(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_PHP_BINARY'];
    }

    /**
     * @return string
     */
    public static function get_MVC_BIN_PS(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_BIN_PS'];
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_EVENT_RUN(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_EVENT_RUN'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_EVENT_RUN(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_EVENT_RUN'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_EVENT_ENABLE_WILDCARD(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_EVENT_ENABLE_WILDCARD'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_EVENT_ENABLE_WILDCARD(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_EVENT_ENABLE_WILDCARD'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_REQUEST(): bool
    {
        return (bool) $GLOBALS['aConfig']['MVC_LOG_REQUEST'];
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_REQUEST(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_REQUEST'] = $bVar;
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_REQUEST(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_REQUEST'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_LOG_FILE_REQUEST(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FILE_REQUEST'] = $sLogFileName;
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_PROCESS(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_PROCESS'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_LOG_FILE_PROCESS(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FILE_PROCESS'] = $sLogFileName;
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_QUEUE(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_QUEUE'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_LOG_FILE_QUEUE(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FILE_QUEUE'] = $sLogFileName;
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_CRON(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_CRON'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_LOG_FILE_CRON(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FILE_CRON'] = $sLogFileName;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_SQL(): bool
    {
        return (bool) $GLOBALS['aConfig']['MVC_LOG_SQL'];
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_SQL(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_SQL'] = $bVar;
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_SQL(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_SQL'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_LOG_FILE_SQL(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FILE_SQL'] = $sLogFileName;
    }

    /**
     * @return string
     */
    public static function get_MVC_PHP_SERVER(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_PHP_SERVER'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_PHP_SERVER(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_PHP_SERVER'] = $sLogFileName;
    }

    /**
     * @return string
     */
    public static function get_MVC_LOG_FILE_ROUTEINTERVALL(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_LOG_FILE_ROUTEINTERVALL'];
    }

    /**
     * @param string $sLogFileName
     * @return void
     */
    public static function set_MVC_LOG_FILE_ROUTEINTERVALL(string $sLogFileName = ''): void
    {
        $GLOBALS['aConfig']['MVC_LOG_FILE_ROUTEINTERVALL'] = $sLogFileName;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_EVENT(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_EVENT'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_EVENT(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_EVENT'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_DEFAULT(): bool
    {
        return (bool) filter_var(($GLOBALS['aConfig']['MVC_LOG_DEFAULT'] ?? true), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_DEFAULT(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_DEFAULT'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_ERROR(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_ERROR'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_ERROR(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_ERROR'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_WARNING(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_WARNING'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_WARNING(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_WARNING'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_NOTICE(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_NOTICE'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_NOTICE(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_NOTICE'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_POLICY(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_POLICY'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_POLICY(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_POLICY'] = $bVar;
    }

    /**
     * @return bool
     */
    public static function get_MVC_LOG_ROUTEINTERVALL(): bool
    {
        return (bool) filter_var($GLOBALS['aConfig']['MVC_LOG_ROUTEINTERVALL'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param bool $bVar
     * @return void
     */
    public static function set_MVC_LOG_ROUTEINTERVALL(bool $bVar = false): void
    {
        $GLOBALS['aConfig']['MVC_LOG_ROUTEINTERVALL'] = $bVar;
    }

    /**
     * @return array
     */
    public static function get_MVC_ROUTING_DIR(): array
    {
        return (array) ($GLOBALS['aConfig']['MVC_ROUTING_DIR'] ?? array());
    }

    /**
     * @return string
     */
    public static function get_MVC_ROUTE_PREFIX(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_ROUTE_PREFIX'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_ROUTE_PREFIX(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_ROUTE_PREFIX'] = $sPrefix;
    }

    #-------------------------------------------------------------------------------------------------------------------
    # Queue

    /**
     * @return string
     */
    public static function get_MVC_QUEUE_ROUTE_PREFIX(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_QUEUE_ROUTE_PREFIX'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_QUEUE_ROUTE_PREFIX(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_QUEUE_ROUTE_PREFIX'] = $sPrefix;
    }

    /**
     * @return string
     */
    public static function get_MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX'] = $sPrefix;
    }

    /**
     * @return string
     */
    public static function get_MVC_QUEUE_RUN(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_QUEUE_RUN'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_QUEUE_RUN(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_QUEUE_RUN'] = $sPrefix;
    }

    /**
     * @return string
     */
    public static function get_MVC_QUEUE_RUN_CLASSMETHOD(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_QUEUE_RUN_CLASSMETHOD'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_QUEUE_RUN_CLASSMETHOD(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_QUEUE_RUN_CLASSMETHOD'] = $sPrefix;
    }

    /**
     * @return string
     */
    public static function get_MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD'] = $sPrefix;
    }

    /**
     * @return int
     */
    public static function get_MVC_QUEUE_RUNTIME_SECONDS(): int
    {
        return (int) $GLOBALS['aConfig']['MVC_QUEUE_RUNTIME_SECONDS'];
    }

    /**
     * @param int $iValue
     * @return void
     */
    public static function set_MVC_QUEUE_RUNTIME_SECONDS(int $iValue = 300): void
    {
        $GLOBALS['aConfig']['MVC_QUEUE_RUNTIME_SECONDS'] = $iValue;
    }

    #-------------------------------------------------------------------------------------------------------------------
    # Process

    /**
     * @return int
     */
    public static function get_MVC_PROCESS_MAX_PROCESSES_OVERALL(): int
    {
        return (int) $GLOBALS['aConfig']['MVC_PROCESS_MAX_PROCESSES_OVERALL'];
    }

    /**
     * @param int $iValue
     * @return void
     */
    public static function set_MVC_PROCESS_MAX_PROCESSES_OVERALL(int $iValue = 30): void
    {
        $GLOBALS['aConfig']['MVC_PROCESS_MAX_PROCESSES_OVERALL'] = $iValue;
    }

    /**
     * @return string
     */
    public static function get_MVC_PROCESS_PID_FILE_DIR(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_PROCESS_PID_FILE_DIR'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_PROCESS_PID_FILE_DIR(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_PROCESS_PID_FILE_DIR'] = $sPrefix;
    }

    #-------------------------------------------------------------------------------------------------------------------
    # cron

    /**
     * @return string
     */
    public static function get_MVC_CRON_ROUTE(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_CRON_ROUTE'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_CRON_ROUTE(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_CRON_ROUTE'] = $sPrefix;
    }

    /**
     * @return string
     */
    public static function get_MVC_CRON_RUN_CLASSMETHOD(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_CRON_RUN_CLASSMETHOD'];
    }

    /**
     * @param string $sPrefix
     * @return void
     */
    public static function set_MVC_CRON_RUN_CLASSMETHOD(string $sPrefix = ''): void
    {
        $GLOBALS['aConfig']['MVC_CRON_RUN_CLASSMETHOD'] = $sPrefix;
    }

    /**
     * @return string
     */
    public static function get_MVC_ROUTE_CLASS(): string
    {
        return (string) $GLOBALS['aConfig']['MVC_ROUTE_CLASS'];
    }

    /**
     * @param string $sRouteClass
     * @return void
     */
    public static function set_MVC_ROUTE_CLASS(string $sRouteClass = ''): void
    {
        $GLOBALS['aConfig']['MVC_ROUTE_CLASS'] = $sRouteClass;
    }

    #-------------------------------------------------------------------------------------------------------------------

    /**
     * @param $aConfigFile
     * @return void
     * @throws \ReflectionException
     */
    public static function init($aConfigFile = array())
    {
        global $aConfig;

        foreach ($aConfigFile as $sConfigFile)
        {
            require self::get_MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR() . '/' . $sConfigFile . '.php';
        }
    }
}