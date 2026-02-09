<?php

namespace MVC;

class Konfig
{
	public const timestamp = '1770652178';

	protected const MVC_ENV = 'develop';
	protected const MVC_INFOTOOL_ENABLE = true;
	protected const MVC_LOG_AUTOLOADER = false;
	protected const MVC_PHP_SERVER = '127.0.0.1:1969';
	protected const MVC_BIN_PHP_BINARY = '/usr/bin/php';
	protected const MVC_BIN_PS = '/usr/bin/ps';
	protected const MVC_BIN_SED = '/usr/bin/sed';
	protected const MVC_BIN_MOVE = '/usr/bin/mv';
	protected const MVC_BIN_GREP = '/usr/bin/grep';
	protected const MVC_BIN_FIND = '/usr/bin/find';
	protected const MVC_BIN_REMOVE = '/usr/bin/rm';
	protected const MVC_BIN_XARGS = '/usr/bin/xargs';
	protected const MVC_ROUTE_CLASS = '\\RouteDB\\Model\\Route';
	protected const MVC_METHODNAME_PRECONSTRUCT = '__preconstruct';
	protected const MVC_WEB_ROOT = '/';
	protected const MVC_BASE_PATH = '/var/www/html';
	protected const MVC_APPLICATION_PATH = '/var/www/html/application';
	protected const MVC_PUBLIC_PATH = '/var/www/html/public';
	protected const MVC_APPLICATION_INIT_DIR = '/var/www/html/application/init';
	protected const MVC_LIBRARY = '/var/www/html/application/library';
	protected const MVC_MODULES_DIR = '/var/www/html/modules';
	protected const MVC_CONFIG_DIR = '/var/www/html/config';
	protected const MVC_EVENT = array (
);
	protected const MVC_EVENT_ENABLE_WILDCARD = true;
	protected const MVC_LOG_SQL = true;
	protected const MVC_LOG_EVENT = false;
	protected const MVC_LOG_EVENT_RUN = false;
	protected const MVC_LOG_POLICY = true;
	protected const MVC_LOG_PROCESS = true;
	protected const MVC_LOG_QUEUE = true;
	protected const MVC_LOG_CRON = true;
	protected const MVC_LOG_ERROR = true;
	protected const MVC_LOG_NOTICE = true;
	protected const MVC_LOG_WARNING = true;
	protected const MVC_LOG_REQUEST = true;
	protected const MVC_LOG_DEFAULT = true;
	protected const MVC_LOG_ROUTEINTERVALL = false;
	protected const MVC_LOG_FORCE_LINEBREAK = true;
	protected const MVC_LOG_FILE_DIR = '/var/www/html/application/log/';
	protected const MVC_LOG_FILE_DEFAULT = '/var/www/html/application/log/default.log';
	protected const MVC_LOG_FILE_ERROR = '/var/www/html/application/log/error.log';
	protected const MVC_LOG_FILE_WARNING = '/var/www/html/application/log/warning.log';
	protected const MVC_LOG_FILE_NOTICE = '/var/www/html/application/log/notice.log';
	protected const MVC_LOG_FILE_POLICY = '/var/www/html/application/log/policy.log';
	protected const MVC_LOG_FILE_EVENT = '/var/www/html/application/log/event.log';
	protected const MVC_LOG_FILE_EVENT_RUN = '/var/www/html/application/log/event_run.log';
	protected const MVC_LOG_FILE_REQUEST = '/var/www/html/application/log/request.log';
	protected const MVC_LOG_FILE_SQL = '/var/www/html/application/log/sql.log';
	protected const MVC_LOG_FILE_ROUTEINTERVALL = '/var/www/html/application/log/route_intervall.log';
	protected const MVC_LOG_FILE_PROCESS = '/var/www/html/application/log/process.log';
	protected const MVC_LOG_FILE_QUEUE = '/var/www/html/application/log/queue.log';
	protected const MVC_LOG_FILE_CRON = '/var/www/html/application/log/cron.log';
	protected const MVC_LOG_FILE_DB_DIR = '/tmp/';
	protected const MVC_LOG_DETAIL = array (
  'date' => true,
  'host' => true,
  'env' => true,
  'ip' => true,
  'uniqueid' => true,
  'sessionid' => true,
  'count' => true,
  'debug' => true,
  'message' => true,
);
	protected const MVC_CACHE_DIR = '/var/www/html/application/cache';
	protected const MVC_CACHE_CONFIG = array (
  'bCaching' => true,
  'sCacheDir' => '/var/www/html/application/cache',
  'iDeleteAfterMinutes' => 1440,
);
	protected const MVC_SSL_PORT = 443;
	protected const MVC_SECURE_REQUEST = true;
	protected const MVC_SESSION_NAMESPACE = 'Emvicy';
	protected const MVC_SESSION_PATH = '/var/www/html/application/session';
	protected const MVC_SESSION_OPTIONS = array (
  'cookie_httponly' => true,
  'auto_start' => 0,
  'save_path' => '/var/www/html/application/session',
  'cookie_secure' => true,
  'name' => 'Emvicy_secure',
  'save_handler' => 'files',
  'cookie_lifetime' => 0,
  'gc_maxlifetime' => 65535,
  'gc_probability' => 1,
  'use_strict_mode' => 1,
  'use_cookies' => 1,
  'use_only_cookies' => 1,
  'upload_progress.enabled' => 1,
);
	protected const MVC_SESSION_ENABLE = false;
	protected const MVC_CLI = false;
	protected const MVC_MODULE_PRIMARY_ESSENTIAL = '/.primary';
	protected const MVC_MODULE_PRIMARY = array (
  0 => 'Foo',
);
	protected const MVC_MODULE_PRIMARY_NAME = 'Foo';
	protected const MVC_MODULE_PRIMARY_DIR = '/var/www/html/modules/Foo';
	protected const MVC_MODULE_PRIMARY_CONFIG_DIR = '/var/www/html/modules/Foo/etc/config';
	protected const MVC_MODULE_PRIMARY_CONTROLLER_DIR = '/var/www/html/modules/Foo/Controller';
	protected const MVC_MODULE_PRIMARY_DATATYPE_DIR = '/var/www/html/modules/Foo/DataType';
	protected const MVC_MODULE_PRIMARY_ETC_DIR = '/var/www/html/modules/Foo/etc';
	protected const MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR = '/var/www/html/modules/Foo/etc/config/Foo/config';
	protected const MVC_MODULE_PRIMARY_MODEL_DIR = '/var/www/html/modules/Model';
	protected const MVC_MODULE_PRIMARY_POLICY_DIR = '/var/www/html/modules/Policy';
	protected const MVC_MODULE_PRIMARY_VIEW_DIR = '/var/www/html/modules/View';
	protected const MVC_MODULE_PRIMARY_COMPOSER_DIR = '/var/www/html/modules/Foo/etc/config/Foo';
	protected const MODULE = 'YTozOntzOjI6IldzIjthOjExOntzOjEwOiJzb2NrZXRGaWxlIjtzOjE2OiIvdG1wL3BocHdzcy5zb2NrIjtzOjk6InNQcm90b2NvbCI7czo2OiJ3c3M6Ly8iO3M6ODoic0FkZHJlc3MiO3M6NzoiMC4wLjAuMCI7czo1OiJpUG9ydCI7aTo4MDAwO3M6NToic1BhdGgiO3M6OToiL0luZm9ybWVyIjtzOjc6InNPcmlnaW4iO3M6NzoiMC4wLjAuMCI7czoxMjoiYkNoZWNrT3JpZ2luIjtiOjA7czo4OiJiVmVyYm9zZSI7YjoxO3M6MTE6ImlNYXhDbGllbnRzIjtpOjEwMDtzOjIwOiJpTWF4Q29ubmVjdGlvbnNQZXJJcCI7aToyMDtzOjg6IkRBVEFUWVBFIjthOjQ6e3M6MzoiZGlyIjtzOjMzOiIvdmFyL3d3dy9odG1sL21vZHVsZXMvV3MvRGF0YVR5cGUiO3M6OToidW5saW5rRGlyIjtiOjA7czoxMjoiY3JlYXRlRXZlbnRzIjtiOjE7czo1OiJjbGFzcyI7YToxOntzOjExOiJEVFdzUGFja2FnZSI7YTo2OntzOjQ6Im5hbWUiO3M6MTE6IkRUV3NQYWNrYWdlIjtzOjQ6ImZpbGUiO3M6MTU6IkRUV3NQYWNrYWdlLnBocCI7czo5OiJuYW1lc3BhY2UiO3M6MTE6IldzXERhdGFUeXBlIjtzOjE5OiJjcmVhdGVIZWxwZXJNZXRob2RzIjtiOjE7czo4OiJjb25zdGFudCI7YTowOnt9czo4OiJwcm9wZXJ0eSI7YTo0OntpOjA7YTo1OntzOjM6ImtleSI7czo0OiJzQXBwIjtzOjM6InZhciI7czo2OiJzdHJpbmciO3M6NToidmFsdWUiO3M6ODoiSW5mb3JtZXIiO3M6ODoicmVxdWlyZWQiO2I6MTtzOjEyOiJmb3JjZUNhc3RpbmciO2I6MTt9aToxO2E6NTp7czozOiJrZXkiO3M6Nzoic0FjdGlvbiI7czozOiJ2YXIiO3M6Njoic3RyaW5nIjtzOjU6InZhbHVlIjtzOjQ6ImVjaG8iO3M6ODoicmVxdWlyZWQiO2I6MTtzOjEyOiJmb3JjZUNhc3RpbmciO2I6MTt9aToyO2E6NTp7czozOiJrZXkiO3M6NToic0RhdGEiO3M6MzoidmFyIjtzOjY6InN0cmluZyI7czo1OiJ2YWx1ZSI7czowOiIiO3M6ODoicmVxdWlyZWQiO2I6MTtzOjEyOiJmb3JjZUNhc3RpbmciO2I6MTt9aTozO2E6NTp7czozOiJrZXkiO3M6NToic1R5cGUiO3M6MzoidmFyIjtzOjY6InN0cmluZyI7czo1OiJ2YWx1ZSI7czo0OiJpbmZvIjtzOjg6InJlcXVpcmVkIjtiOjE7czoxMjoiZm9yY2VDYXN0aW5nIjtiOjE7fX19fX19czozOiJGb28iO2E6ODp7czoyOiJEQiI7YTozOntzOjI6ImRiIjthOjc6e3M6NDoidHlwZSI7czo1OiJteXNxbCI7czo0OiJob3N0IjtzOjI6ImRiIjtzOjQ6InBvcnQiO3M6NDoiMzMwNiI7czo4OiJ1c2VybmFtZSI7czo0OiJyb290IjtzOjg6InBhc3N3b3JkIjtzOjQ6InJvb3QiO3M6NjoiZGJuYW1lIjtzOjg6IkVtdmljeTN4IjtzOjc6ImNoYXJzZXQiO3M6NDoidXRmOCI7fXM6NzoiY2FjaGluZyI7YToyOntzOjc6ImVuYWJsZWQiO2I6MTtzOjg6ImxpZmV0aW1lIjtzOjE6IjEiO31zOjc6ImxvZ2dpbmciO2E6Mzp7czoxMDoibG9nX291dHB1dCI7czo0OiJGSUxFIjtzOjExOiJnZW5lcmFsX2xvZyI7czoyOiJPTiI7czoxNjoiZ2VuZXJhbF9sb2dfZmlsZSI7czoyNToiL3RtcC9FbXZpY3kzeF9kZXZlbG9wLmxvZyI7fX1zOjg6IkRCUmVtb3RlIjthOjM6e3M6MjoiZGIiO2E6Nzp7czo0OiJ0eXBlIjtiOjA7czo0OiJob3N0IjtiOjA7czo0OiJwb3J0IjtiOjA7czo4OiJ1c2VybmFtZSI7YjowO3M6ODoicGFzc3dvcmQiO2I6MDtzOjY6ImRibmFtZSI7YjowO3M6NzoiY2hhcnNldCI7czo0OiJ1dGY4Ijt9czo3OiJjYWNoaW5nIjthOjI6e3M6NzoiZW5hYmxlZCI7YjoxO3M6ODoibGlmZXRpbWUiO3M6MToiMSI7fXM6NzoibG9nZ2luZyI7YTozOntzOjEwOiJsb2dfb3V0cHV0IjtzOjQ6IkZJTEUiO3M6MTE6ImdlbmVyYWxfbG9nIjtzOjM6Ik9GRiI7czoxNjoiZ2VuZXJhbF9sb2dfZmlsZSI7czoxNzoiL3RtcC9fZGV2ZWxvcC5sb2ciO319czo1OiJxdWV1ZSI7YToxOntzOjY6IndvcmtlciI7YToxMjp7czo4OiJEdW1teTo6MSI7czoyMzoiXEZvb1xNb2RlbFxXb3JrZXJcRHVtbXkiO3M6ODoiRHVtbXk6OjIiO3M6MjM6IlxGb29cTW9kZWxcV29ya2VyXER1bW15IjtzOjg6IkR1bW15OjozIjtzOjIzOiJcRm9vXE1vZGVsXFdvcmtlclxEdW1teSI7czo4OiJEdW1teTo6NCI7czoyMzoiXEZvb1xNb2RlbFxXb3JrZXJcRHVtbXkiO3M6ODoiRHVtbXk6OjUiO3M6MjM6IlxGb29cTW9kZWxcV29ya2VyXER1bW15IjtzOjg6IkR1bW15Ojo2IjtzOjIzOiJcRm9vXE1vZGVsXFdvcmtlclxEdW1teSI7czo4OiJEdW1teTo6NyI7czoyMzoiXEZvb1xNb2RlbFxXb3JrZXJcRHVtbXkiO3M6ODoiRHVtbXk6OjgiO3M6MjM6IlxGb29cTW9kZWxcV29ya2VyXER1bW15IjtzOjg6IkR1bW15Ojo5IjtzOjIzOiJcRm9vXE1vZGVsXFdvcmtlclxEdW1teSI7czo5OiJEdW1teTo6MTAiO3M6MjM6IlxGb29cTW9kZWxcV29ya2VyXER1bW15IjtzOjk6IkR1bW15OjoxMSI7czoyMzoiXEZvb1xNb2RlbFxXb3JrZXJcRHVtbXkiO3M6OToiRHVtbXk6OjEyIjtzOjIzOiJcRm9vXE1vZGVsXFdvcmtlclxEdW1teSI7fX1zOjg6IkRBVEFUWVBFIjthOjQ6e3M6MzoiZGlyIjtzOjM0OiIvdmFyL3d3dy9odG1sL21vZHVsZXMvRm9vL0RhdGFUeXBlIjtzOjk6InVubGlua0RpciI7YjowO3M6MTI6ImNyZWF0ZUV2ZW50cyI7YjoxO3M6NToiY2xhc3MiO2E6MTp7czoxOToiRFRSb3V0aW5nQWRkaXRpb25hbCI7YTo3OntzOjQ6Im5hbWUiO3M6MTk6IkRUUm91dGluZ0FkZGl0aW9uYWwiO3M6NDoiZmlsZSI7czoyMzoiRFRSb3V0aW5nQWRkaXRpb25hbC5waHAiO3M6NzoiZXh0ZW5kcyI7czozMzoiXE1WQ1xEYXRhVHlwZVxEVFJvdXRpbmdBZGRpdGlvbmFsIjtzOjk6Im5hbWVzcGFjZSI7czoxMjoiRm9vXERhdGFUeXBlIjtzOjE5OiJjcmVhdGVIZWxwZXJNZXRob2RzIjtiOjE7czo4OiJjb25zdGFudCI7YTowOnt9czo4OiJwcm9wZXJ0eSI7YTowOnt9fX19czo3OiJTRVNTSU9OIjthOjI6e3M6Mjc6ImFFbmFibGVTZXNzaW9uRm9yQ29udHJvbGxlciI7YToxOntpOjA7czoxOiIqIjt9czoyODoiYURpc2FibGVTZXNzaW9uRm9yQ29udHJvbGxlciI7YTowOnt9fXM6MzoiQ1NQIjthOjY6e3M6MTU6IlgtRnJhbWUtT3B0aW9ucyI7czoxODoiIGFsbG93LWZyb20gJ25vbmUnIjtzOjIzOiJDb250ZW50LVNlY3VyaXR5LVBvbGljeSI7czozMDM6ImRlZmF1bHQtc3JjICdzZWxmJztzY3JpcHQtc3JjICdzZWxmJyAndW5zYWZlLWlubGluZSc7c3R5bGUtc3JjICdzZWxmJyAndW5zYWZlLWlubGluZSc7aW1nLXNyYyAnc2VsZicgYmxvYjogZGF0YTogO2Nvbm5lY3Qtc3JjICdzZWxmJyB3c3M6Ly9lbXZpY3kzeC5kZGV2LnNpdGU6ODAwMDtmb250LXNyYyAnc2VsZic7b2JqZWN0LXNyYyAnbm9uZSc7bWVkaWEtc3JjICdzZWxmJztjaGlsZC1zcmMgJ3NlbGYnO3JlcG9ydC11cmkgLztmb3JtLWFjdGlvbiAnc2VsZic7ZnJhbWUtYW5jZXN0b3JzICdub25lJztmcmFtZS1zcmMgJ3NlbGYnOyI7czoxNjoiWC1YU1MtUHJvdGVjdGlvbiI7czoxMzoiMTsgbW9kZT1ibG9jayI7czoyNToiU3RyaWN0LVRyYW5zcG9ydC1TZWN1cml0eSI7czoxNjoibWF4LWFnZT02MzA3MjAwMCI7czoyNToiWC1Db250ZW50LVNlY3VyaXR5LVBvbGljeSI7czozMDM6ImRlZmF1bHQtc3JjICdzZWxmJztzY3JpcHQtc3JjICdzZWxmJyAndW5zYWZlLWlubGluZSc7c3R5bGUtc3JjICdzZWxmJyAndW5zYWZlLWlubGluZSc7aW1nLXNyYyAnc2VsZicgYmxvYjogZGF0YTogO2Nvbm5lY3Qtc3JjICdzZWxmJyB3c3M6Ly9lbXZpY3kzeC5kZGV2LnNpdGU6ODAwMDtmb250LXNyYyAnc2VsZic7b2JqZWN0LXNyYyAnbm9uZSc7bWVkaWEtc3JjICdzZWxmJztjaGlsZC1zcmMgJ3NlbGYnO3JlcG9ydC11cmkgLztmb3JtLWFjdGlvbiAnc2VsZic7ZnJhbWUtYW5jZXN0b3JzICdub25lJztmcmFtZS1zcmMgJ3NlbGYnOyI7czoxMjoiWC1XZWJraXQtQ1NQIjtzOjMwMzoiZGVmYXVsdC1zcmMgJ3NlbGYnO3NjcmlwdC1zcmMgJ3NlbGYnICd1bnNhZmUtaW5saW5lJztzdHlsZS1zcmMgJ3NlbGYnICd1bnNhZmUtaW5saW5lJztpbWctc3JjICdzZWxmJyBibG9iOiBkYXRhOiA7Y29ubmVjdC1zcmMgJ3NlbGYnIHdzczovL2VtdmljeTN4LmRkZXYuc2l0ZTo4MDAwO2ZvbnQtc3JjICdzZWxmJztvYmplY3Qtc3JjICdub25lJzttZWRpYS1zcmMgJ3NlbGYnO2NoaWxkLXNyYyAnc2VsZic7cmVwb3J0LXVyaSAvO2Zvcm0tYWN0aW9uICdzZWxmJztmcmFtZS1hbmNlc3RvcnMgJ25vbmUnO2ZyYW1lLXNyYyAnc2VsZic7Ijt9czo0OiJNZW51IjthOjE6e3M6ODoiZnJvbnRlbmQiO2E6NTp7aTowO3M6NDoidXNlciI7aToxO3M6NzoiaW1wcmludCI7aToyO3M6MTM6InByaXZhY3lQb2xpY3kiO2k6MztzOjQ6ImluZm8iO3M6MTM6IlB1bGxEb3duIE1lbnUiO2E6NDp7aTowO3M6NDoiaW5mbyI7aToxO3M6NDoidXNlciI7aToyO3M6NzoiaW1wcmludCI7aTozO3M6MTM6InByaXZhY3lQb2xpY3kiO319fXM6NDoiY3JvbiI7YToyOntpOjA7czoxOToiL34vcXVldWUvd29ya2VyL3J1biI7aToxO3M6MTA6Ii93cy9zZXJ2ZS8iO319czo1OiJFbWFpbCI7YTo4OntzOjk6Im9DYWxsYmFjayI7TzoxNjoiT3Bpc1xDbG9zdXJlXEJveCI6Mjp7aTowO2k6MTtpOjE7YToxOntzOjQ6ImluZm8iO2E6Mjp7czozOiJrZXkiO3M6MzI6IjU5M2UwNGNhNTI5MGE4OGNiN2JiYzIwMGM2MmJiZDg4IjtzOjQ6ImJvZHkiO3M6MjgxOiJmdW5jdGlvbigkb0VtYWlsKSB7CgogICAgICAgIC8qKgogICAgICAgICAqIChOaWNodC1MSVZFKTogSW1tZXIgYW4gZGllc2UgRS1NYWlsLUFkcmVzc2UgdmVyc2VuZGVuCiAgICAgICAgICovCiAgICAgICAgJG9FbWFpbC0+c2V0X3JlY2lwaWVudE1haWxBZHJlc3NlcyhhcnJheSgnZ3VpZG9AdWVmZmluZy5uZXQnKSk7CgogICAgICAgIC8vIHNlbmQgZS1tYWlsIHZpYSBTTVRQCiAgICAgICAgcmV0dXJuIFxFbWFpbFxNb2RlbFxTbXRwOjpzZW5kVmlhUGhwTWFpbGVyKCRvRW1haWwpOwogICAgfSI7fX19czoxOToic1NlbmRlckVtYWlsQWRkcmVzcyI7czoxOToibm9yZXBseUBleGFtcGxlLmNvbSI7czo1OiJzSG9zdCI7czo5OiJsb2NhbGhvc3QiO3M6NToiaVBvcnQiO3M6NDoiMTAyNSI7czo3OiJzU2VjdXJlIjtzOjA6IiI7czo1OiJiQXV0aCI7czoxOiIwIjtzOjk6InNVc2VybmFtZSI7czo0OiJudWxsIjtzOjk6InNQYXNzd29yZCI7czo0OiJudWxsIjt9fQ==';
	protected const MVC_MODULE_SECONDARY = array (
  0 => 'Email',
  2 => 'Paginator',
  3 => 'RouteDB',
  4 => 'Ws',
);
	protected const MVC_MODULE_SET = array (
  'SECONDARY' => 
  array (
    0 => 'Email',
    2 => 'Paginator',
    3 => 'RouteDB',
    4 => 'Ws',
  ),
  'PRIMARY' => 
  array (
    0 => 'Foo',
  ),
);
	protected const MVC_ROUTING_DIR = array (
  0 => '/var/www/html/modules/Foo/etc/routing',
  1 => '/var/www/html/modules/Ws/etc/routing',
);
	protected const MVC_ROUTING_FALLBACK = '\\Foo\\Controller\\Index::notFound';
	protected const MVC_VIEW_TEMPLATE_DIR = '/var/www/html/modules/Foo/templates';
	protected const MVC_SMARTY_CACHE_STATUS = false;
	protected const MVC_SMARTY_CACHE_DIR = '/var/www/html/application/cache';
	protected const MVC_SMARTY_TEMPLATE_DIR = '/var/www/html/modules/Foo/templates';
	protected const MVC_SMARTY_TEMPLATE_DEFAULT = 'Frontend/layout/index.tpl';
	protected const MVC_SMARTY_TEMPLATE_CACHE_DIR = '/var/www/html/application/templates_c';
	protected const MVC_SMARTY_PLUGINS_DIR = array (
  0 => '/var/www/html/application/smartyPlugins',
  1 => '/var/www/html/modules/Foo/etc/smartyPlugins',
);
	protected const MVC_POLICY = array (
);
	protected const MVC_UNIQUE_ID = '20260209154938698a02122be87';
	protected const MVC_ROUTE_PREFIX = '/~';
	protected const MVC_QUEUE_ROUTE_PREFIX = '/~/queue';
	protected const MVC_QUEUE_RUN = '/~/queue/worker/run';
	protected const MVC_QUEUE_RUN_CLASSMETHOD = '\\App\\Controller\\Queue::workerRun';
	protected const MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX = '/~/queue/worker';
	protected const MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD = '\\App\\Controller\\Queue::workerAutoRouteResolve';
	protected const MVC_QUEUE_RUNTIME_SECONDS = 300;
	protected const MVC_PROCESS_MAX_PROCESSES_OVERALL = 30;
	protected const MVC_PROCESS_PID_FILE_DIR = '/var/www/html/application/pid/';
	protected const MVC_CRON_ROUTE = '/~/cron/run';
	protected const MVC_CRON_RUN_CLASSMETHOD = '\\App\\Controller\\Cron::run';
	protected const EMVICY_CONSOLE = 'YToxOntpOjA7YTo2OntzOjg6InJlZ2lzdGVyIjtzOjE1OiJyb3V0ZXM6ZGJpbXBvcnQiO3M6NzoiYWxpYXNlcyI7YToxOntpOjA7czo1OiJydGRiaSI7fXM6MTE6ImRlc2NyaXB0aW9uIjtzOjExNzoiG1swOzM2bXBocCBlbXZpY3kgcm91dGVzOmRiaW1wb3J0G1swbSA9PiBpbXBvcnRzIFJvdXRlIGNvbmZpZyBpbnRvIGRhdGFiYXNlIHRhYmxlIGBSb3V0ZURCTW9kZWxEQlRhYmxlUm91dGVgIGZvciBuZXcuIjtzOjEyOiJhcmd1bWVudE5hbWUiO3M6MDoiIjtzOjEyOiJhcmd1bWVudE1vZGUiO2k6MjtzOjQ6ImNvZGUiO086MTY6Ik9waXNcQ2xvc3VyZVxCb3giOjI6e2k6MDtpOjE7aToxO2E6MTp7czo0OiJpbmZvIjthOjI6e3M6Mzoia2V5IjtzOjMyOiI5OWE1ZWRlZjQ3ZDEzNmJjMDYzNDdkMjgzMWMyZGQyNyI7czo0OiJib2R5IjtzOjMwMzoiZnVuY3Rpb24gKFxTeW1mb255XENvbXBvbmVudFxDb25zb2xlXElucHV0XElucHV0SW50ZXJmYWNlICRvSW5wdXRJbnRlcmZhY2UsIFxTeW1mb255XENvbXBvbmVudFxDb25zb2xlXE91dHB1dFxPdXRwdXRJbnRlcmZhY2UgJG9PdXRwdXRJbnRlcmZhY2UpOiBpbnQgewogICAgICAgIFxSb3V0ZURCXE1vZGVsXFJvdXRlOjppbml0KAogICAgICAgICAgICBiRm9yY2VJbXBvcnQ6IHRydWUKICAgICAgICApOwogICAgICAgIHJldHVybiBcU3ltZm9ueVxDb21wb25lbnRcQ29uc29sZVxDb21tYW5kXENvbW1hbmQ6OlNVQ0NFU1M7CiAgICB9Ijt9fX19fQ==';
	protected const APP = array (
  'GETTEXT' => '/var/www/App/languages',
  'LANG' => 'de_DE',
);
	protected const MVC_VERSION = 'Emvicy=3.x';
	protected const MVC_CORE = array (
  'version' => 'Emvicy=3.x',
  'phpExtensionsRequired' => 
  array (
    0 => 'Core',
    1 => 'ctype',
    2 => 'curl',
    3 => 'date',
    4 => 'dom',
    5 => 'fileinfo',
    6 => 'filter',
    7 => 'iconv',
    8 => 'json',
    9 => 'mbstring',
    10 => 'PDO',
    11 => 'Phar',
    12 => 'posix',
    13 => 'Reflection',
    14 => 'session',
    15 => 'SimpleXML',
    16 => 'standard',
    17 => 'SPL',
    18 => 'zip',
  ),
  'phpFunctionsRequired' => 
  array (
    0 => 'mb_strlen',
    1 => 'iconv',
  ),
);
	public static function get_MVC_ENV()
	{
		return self::MVC_ENV;
	}
	public static function get_MVC_INFOTOOL_ENABLE()
	{
		return self::MVC_INFOTOOL_ENABLE;
	}
	public static function get_MVC_LOG_AUTOLOADER()
	{
		return self::MVC_LOG_AUTOLOADER;
	}
	public static function get_MVC_PHP_SERVER()
	{
		return self::MVC_PHP_SERVER;
	}
	public static function get_MVC_BIN_PHP_BINARY()
	{
		return self::MVC_BIN_PHP_BINARY;
	}
	public static function get_MVC_BIN_PS()
	{
		return self::MVC_BIN_PS;
	}
	public static function get_MVC_BIN_SED()
	{
		return self::MVC_BIN_SED;
	}
	public static function get_MVC_BIN_MOVE()
	{
		return self::MVC_BIN_MOVE;
	}
	public static function get_MVC_BIN_GREP()
	{
		return self::MVC_BIN_GREP;
	}
	public static function get_MVC_BIN_FIND()
	{
		return self::MVC_BIN_FIND;
	}
	public static function get_MVC_BIN_REMOVE()
	{
		return self::MVC_BIN_REMOVE;
	}
	public static function get_MVC_BIN_XARGS()
	{
		return self::MVC_BIN_XARGS;
	}
	public static function get_MVC_ROUTE_CLASS()
	{
		return self::MVC_ROUTE_CLASS;
	}
	public static function get_MVC_METHODNAME_PRECONSTRUCT()
	{
		return self::MVC_METHODNAME_PRECONSTRUCT;
	}
	public static function get_MVC_WEB_ROOT()
	{
		return self::MVC_WEB_ROOT;
	}
	public static function get_MVC_BASE_PATH()
	{
		return self::MVC_BASE_PATH;
	}
	public static function get_MVC_APPLICATION_PATH()
	{
		return self::MVC_APPLICATION_PATH;
	}
	public static function get_MVC_PUBLIC_PATH()
	{
		return self::MVC_PUBLIC_PATH;
	}
	public static function get_MVC_APPLICATION_INIT_DIR()
	{
		return self::MVC_APPLICATION_INIT_DIR;
	}
	public static function get_MVC_LIBRARY()
	{
		return self::MVC_LIBRARY;
	}
	public static function get_MVC_MODULES_DIR()
	{
		return self::MVC_MODULES_DIR;
	}
	public static function get_MVC_CONFIG_DIR()
	{
		return self::MVC_CONFIG_DIR;
	}
	public static function get_MVC_EVENT()
	{
		return self::MVC_EVENT;
	}
	public static function get_MVC_EVENT_ENABLE_WILDCARD()
	{
		return self::MVC_EVENT_ENABLE_WILDCARD;
	}
	public static function get_MVC_LOG_SQL()
	{
		return self::MVC_LOG_SQL;
	}
	public static function get_MVC_LOG_EVENT()
	{
		return self::MVC_LOG_EVENT;
	}
	public static function get_MVC_LOG_EVENT_RUN()
	{
		return self::MVC_LOG_EVENT_RUN;
	}
	public static function get_MVC_LOG_POLICY()
	{
		return self::MVC_LOG_POLICY;
	}
	public static function get_MVC_LOG_PROCESS()
	{
		return self::MVC_LOG_PROCESS;
	}
	public static function get_MVC_LOG_QUEUE()
	{
		return self::MVC_LOG_QUEUE;
	}
	public static function get_MVC_LOG_CRON()
	{
		return self::MVC_LOG_CRON;
	}
	public static function get_MVC_LOG_ERROR()
	{
		return self::MVC_LOG_ERROR;
	}
	public static function get_MVC_LOG_NOTICE()
	{
		return self::MVC_LOG_NOTICE;
	}
	public static function get_MVC_LOG_WARNING()
	{
		return self::MVC_LOG_WARNING;
	}
	public static function get_MVC_LOG_REQUEST()
	{
		return self::MVC_LOG_REQUEST;
	}
	public static function get_MVC_LOG_DEFAULT()
	{
		return self::MVC_LOG_DEFAULT;
	}
	public static function get_MVC_LOG_ROUTEINTERVALL()
	{
		return self::MVC_LOG_ROUTEINTERVALL;
	}
	public static function get_MVC_LOG_FORCE_LINEBREAK()
	{
		return self::MVC_LOG_FORCE_LINEBREAK;
	}
	public static function get_MVC_LOG_FILE_DIR()
	{
		return self::MVC_LOG_FILE_DIR;
	}
	public static function get_MVC_LOG_FILE_DEFAULT()
	{
		return self::MVC_LOG_FILE_DEFAULT;
	}
	public static function get_MVC_LOG_FILE_ERROR()
	{
		return self::MVC_LOG_FILE_ERROR;
	}
	public static function get_MVC_LOG_FILE_WARNING()
	{
		return self::MVC_LOG_FILE_WARNING;
	}
	public static function get_MVC_LOG_FILE_NOTICE()
	{
		return self::MVC_LOG_FILE_NOTICE;
	}
	public static function get_MVC_LOG_FILE_POLICY()
	{
		return self::MVC_LOG_FILE_POLICY;
	}
	public static function get_MVC_LOG_FILE_EVENT()
	{
		return self::MVC_LOG_FILE_EVENT;
	}
	public static function get_MVC_LOG_FILE_EVENT_RUN()
	{
		return self::MVC_LOG_FILE_EVENT_RUN;
	}
	public static function get_MVC_LOG_FILE_REQUEST()
	{
		return self::MVC_LOG_FILE_REQUEST;
	}
	public static function get_MVC_LOG_FILE_SQL()
	{
		return self::MVC_LOG_FILE_SQL;
	}
	public static function get_MVC_LOG_FILE_ROUTEINTERVALL()
	{
		return self::MVC_LOG_FILE_ROUTEINTERVALL;
	}
	public static function get_MVC_LOG_FILE_PROCESS()
	{
		return self::MVC_LOG_FILE_PROCESS;
	}
	public static function get_MVC_LOG_FILE_QUEUE()
	{
		return self::MVC_LOG_FILE_QUEUE;
	}
	public static function get_MVC_LOG_FILE_CRON()
	{
		return self::MVC_LOG_FILE_CRON;
	}
	public static function get_MVC_LOG_FILE_DB_DIR()
	{
		return self::MVC_LOG_FILE_DB_DIR;
	}
	public static function get_MVC_LOG_DETAIL()
	{
		return self::MVC_LOG_DETAIL;
	}
	public static function get_MVC_CACHE_DIR()
	{
		return self::MVC_CACHE_DIR;
	}
	public static function get_MVC_CACHE_CONFIG()
	{
		return self::MVC_CACHE_CONFIG;
	}
	public static function get_MVC_SSL_PORT()
	{
		return self::MVC_SSL_PORT;
	}
	public static function get_MVC_SECURE_REQUEST()
	{
		return self::MVC_SECURE_REQUEST;
	}
	public static function get_MVC_SESSION_NAMESPACE()
	{
		return self::MVC_SESSION_NAMESPACE;
	}
	public static function get_MVC_SESSION_PATH()
	{
		return self::MVC_SESSION_PATH;
	}
	public static function get_MVC_SESSION_OPTIONS()
	{
		return self::MVC_SESSION_OPTIONS;
	}
	public static function get_MVC_SESSION_ENABLE()
	{
		return self::MVC_SESSION_ENABLE;
	}
	public static function get_MVC_CLI()
	{
		return self::MVC_CLI;
	}
	public static function get_MVC_MODULE_PRIMARY_ESSENTIAL()
	{
		return self::MVC_MODULE_PRIMARY_ESSENTIAL;
	}
	public static function get_MVC_MODULE_PRIMARY()
	{
		return self::MVC_MODULE_PRIMARY;
	}
	public static function get_MVC_MODULE_PRIMARY_NAME()
	{
		return self::MVC_MODULE_PRIMARY_NAME;
	}
	public static function get_MVC_MODULE_PRIMARY_DIR()
	{
		return self::MVC_MODULE_PRIMARY_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_CONFIG_DIR()
	{
		return self::MVC_MODULE_PRIMARY_CONFIG_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_CONTROLLER_DIR()
	{
		return self::MVC_MODULE_PRIMARY_CONTROLLER_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_DATATYPE_DIR()
	{
		return self::MVC_MODULE_PRIMARY_DATATYPE_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_ETC_DIR()
	{
		return self::MVC_MODULE_PRIMARY_ETC_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR()
	{
		return self::MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_MODEL_DIR()
	{
		return self::MVC_MODULE_PRIMARY_MODEL_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_POLICY_DIR()
	{
		return self::MVC_MODULE_PRIMARY_POLICY_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_VIEW_DIR()
	{
		return self::MVC_MODULE_PRIMARY_VIEW_DIR;
	}
	public static function get_MVC_MODULE_PRIMARY_COMPOSER_DIR()
	{
		return self::MVC_MODULE_PRIMARY_COMPOSER_DIR;
	}
	public static function get_MODULE()
	{
		return \MVC\Convert::unserialize(base64_decode(self::MODULE));
	}
	public static function get_MVC_MODULE_SECONDARY()
	{
		return self::MVC_MODULE_SECONDARY;
	}
	public static function get_MVC_MODULE_SET()
	{
		return self::MVC_MODULE_SET;
	}
	public static function get_MVC_ROUTING_DIR()
	{
		return self::MVC_ROUTING_DIR;
	}
	public static function get_MVC_ROUTING_FALLBACK()
	{
		return self::MVC_ROUTING_FALLBACK;
	}
	public static function get_MVC_VIEW_TEMPLATE_DIR()
	{
		return self::MVC_VIEW_TEMPLATE_DIR;
	}
	public static function get_MVC_SMARTY_CACHE_STATUS()
	{
		return self::MVC_SMARTY_CACHE_STATUS;
	}
	public static function get_MVC_SMARTY_CACHE_DIR()
	{
		return self::MVC_SMARTY_CACHE_DIR;
	}
	public static function get_MVC_SMARTY_TEMPLATE_DIR()
	{
		return self::MVC_SMARTY_TEMPLATE_DIR;
	}
	public static function get_MVC_SMARTY_TEMPLATE_DEFAULT()
	{
		return self::MVC_SMARTY_TEMPLATE_DEFAULT;
	}
	public static function get_MVC_SMARTY_TEMPLATE_CACHE_DIR()
	{
		return self::MVC_SMARTY_TEMPLATE_CACHE_DIR;
	}
	public static function get_MVC_SMARTY_PLUGINS_DIR()
	{
		return self::MVC_SMARTY_PLUGINS_DIR;
	}
	public static function get_MVC_POLICY()
	{
		return self::MVC_POLICY;
	}
	public static function get_MVC_UNIQUE_ID()
	{
		return self::MVC_UNIQUE_ID;
	}
	public static function get_MVC_ROUTE_PREFIX()
	{
		return self::MVC_ROUTE_PREFIX;
	}
	public static function get_MVC_QUEUE_ROUTE_PREFIX()
	{
		return self::MVC_QUEUE_ROUTE_PREFIX;
	}
	public static function get_MVC_QUEUE_RUN()
	{
		return self::MVC_QUEUE_RUN;
	}
	public static function get_MVC_QUEUE_RUN_CLASSMETHOD()
	{
		return self::MVC_QUEUE_RUN_CLASSMETHOD;
	}
	public static function get_MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX()
	{
		return self::MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX;
	}
	public static function get_MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD()
	{
		return self::MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD;
	}
	public static function get_MVC_QUEUE_RUNTIME_SECONDS()
	{
		return self::MVC_QUEUE_RUNTIME_SECONDS;
	}
	public static function get_MVC_PROCESS_MAX_PROCESSES_OVERALL()
	{
		return self::MVC_PROCESS_MAX_PROCESSES_OVERALL;
	}
	public static function get_MVC_PROCESS_PID_FILE_DIR()
	{
		return self::MVC_PROCESS_PID_FILE_DIR;
	}
	public static function get_MVC_CRON_ROUTE()
	{
		return self::MVC_CRON_ROUTE;
	}
	public static function get_MVC_CRON_RUN_CLASSMETHOD()
	{
		return self::MVC_CRON_RUN_CLASSMETHOD;
	}
	public static function get_EMVICY_CONSOLE()
	{
		return \MVC\Convert::unserialize(base64_decode(self::EMVICY_CONSOLE));
	}
	public static function get_APP()
	{
		return self::APP;
	}
	public static function get_MVC_VERSION()
	{
		return self::MVC_VERSION;
	}
	public static function get_MVC_CORE()
	{
		return self::MVC_CORE;
	}

}