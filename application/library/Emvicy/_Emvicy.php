<?php


use Emvicy\Emvicy;
use MVC\Config;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#-----------------------------

mvcStoreEnv(realpath(Config::get_MVC_APPLICATION_PATH() . '/../') . '/.version');
\MVC\Application::setServerVarsForCli();
$oSymfonyComponentConsoleApplication = new Application('Emvicy', getenv('Emvicy'));
$oSymfonyComponentConsoleApplication->getDefinition()->setOptions();

#---

$oSymfonyComponentConsoleApplication
    ->register('version')
    ->setAliases(['v'])
    ->setDescription(C_CYAN . "php emvicy version" . C_RESET . ' => displays Emvicy version')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::version();
        return Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('serve')
    ->setAliases(['s'])
    ->setDescription(C_CYAN . "php emvicy serve" . C_RESET . ' => provides a local php-builtIn server')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::serve();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# cron

$oSymfonyComponentConsoleApplication
    ->register('cron:run')
    ->setAliases(['crr'])
    ->setDescription(C_CYAN . "php emvicy cron:run" . C_RESET . ' => runs emvicy cron configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::cronrun();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('cron:list')
    ->setAliases(['crl'])
    ->setDescription(C_CYAN . "php emvicy cron:list" . C_RESET . ' => list cron configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::cronlist();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# queue

$oSymfonyComponentConsoleApplication
    ->register('queue:list')
    ->setAliases(['ql'])
    ->setDescription(C_CYAN . "php emvicy queue:list" . C_RESET . ' => list "Queue Key <=> Worker" configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::queueList();
        return Command::SUCCESS;
    });


#-----------------------------------------------------------------------------------------------------------------------
# policy

$oSymfonyComponentConsoleApplication
    ->register('policy:create')
    ->setAliases(['pc'])
    ->setDescription(C_CYAN . "php emvicy policy:create Bar [?module]" . C_RESET . ' => creates a Policy class `Bar` in the primary module; optional in `module`. ')
    ->addArgument('sClass', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::createPolicy(
            sClass: $oInputInterface->getArgument('sClass'),
            sModuleName: $oInputInterface->getArgument('sModuleName'));
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('policy:list')
    ->setAliases(['pl'])
    ->setDescription(C_CYAN . "php emvicy policy:list" . C_RESET . ' => list available Policy configurations in a markdown table')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::policyList();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# worker

$oSymfonyComponentConsoleApplication
    ->register('worker:create')
    ->setAliases(['wc'])
    ->setDescription(C_CYAN . "php emvicy worker:create Bar [?module]" . C_RESET . ' => creates a Worker class `Bar` in the primary module; optional in `module`. ')
    ->addArgument('sClass', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::createWorker(
            sClass: $oInputInterface->getArgument('sClass'),
            sModuleName: $oInputInterface->getArgument('sModuleName'));
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('worker:run')
    ->setAliases(['wr'])
    ->setDescription(C_CYAN . "php emvicy worker:run" . C_RESET . ' => runs "Queue Key <=> Worker" configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::workerRun();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# clear

$oSymfonyComponentConsoleApplication
    ->register('clear:cache')
    ->setAliases(['cc'])
    ->setDescription(C_CYAN . "php emvicy clear:cache" . C_RESET . ' => clears all contents of cache directory: - /application/cache/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearcache();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:log')
    ->setAliases(['cl'])
    ->setDescription(C_CYAN . "php emvicy clear:log" . C_RESET  . ' => clears all contents of log directory: - /application/log/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearlog();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:session')
    ->setAliases(['cs'])
    ->setDescription(C_CYAN . "php emvicy clear:session" . C_RESET . ' => clears all contents of session directory: - /application/session/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearsession();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:temp')
    ->setAliases(['ct'])
    ->setDescription(C_CYAN . "php emvicy clear:temp" . C_RESET . ' => clears all contents of templates_c directory: - /application/templates_c/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::cleartemp();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:all')
    ->setAliases(['ca'])
    ->setDescription(C_CYAN . "php emvicy clear:all" . C_RESET . ' => clears all contents of temp directories: - `/application/cache/`, - /application/log/, - /application/session/, - /application/templates_c/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearall();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# datatype

$oSymfonyComponentConsoleApplication
    ->register('datatype:all')
    ->setAliases(['dt'])
    ->setDescription(C_CYAN . "php emvicy datatype:all" . C_RESET . ' => creates datatype classes for all modules')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::datatype();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('datatype:module')
    ->setAliases(['dtm'])
    ->setDescription(C_CYAN . "php emvicy datatype:module Foo" . C_RESET . ' => creates datatype classes for module `Foo`')
    ->addArgument('module', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::datatype($oInputInterface->getArgument('module'));
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# routes

$oSymfonyComponentConsoleApplication
    ->register('routes:array')
    ->setAliases(['rt'])
    ->setDescription(C_CYAN . "php emvicy routes:array" . C_RESET  . ' => lists available routes as array/var_export')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::routes();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('routes:json')
    ->setAliases(['rtj'])
    ->setDescription(C_CYAN . "php emvicy routes:json" . C_RESET . ' => lists available routes in JSON format')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::routes('json');
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('routes:list')
    ->setAliases(['rtl'])
    ->setDescription(C_CYAN . "php emvicy routes:list" . C_RESET . ' => lists available routes in a markdown table')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::routes('list');
        return Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('routes:call')
    ->setAliases(['rtc'])
    ->setDescription(C_CYAN . "php emvicy routes:call " . C_RESET . ' => calls a route. Example: ' . C_CYAN . 'php emvicy rtc /' . C_RESET)
    ->addArgument('route', InputArgument::REQUIRED)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {

        $sCommand = 'cd ' . Config::get_MVC_PUBLIC_PATH() . '; ' . Config::get_MVC_BIN_PHP_BINARY() . ' index.php "' . $oInputInterface->getArgument('route') . '"';
        echo shell_exec($sCommand);

        return Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('routes:call-non-blocking')
    ->setAliases(['rtcnb'])
    ->setDescription(C_CYAN . "php emvicy routes:call-non-blocking" . C_RESET . ' => calls a route non-blocking. Example: ' . C_CYAN . 'php emvicy rtcnb /' . C_RESET)
    ->addArgument('route', InputArgument::REQUIRED)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {

        $iPid = \MVC\Process::callRoute(
            sRoute: $oInputInterface->getArgument('route')
        );
        nl();
        echo 'Called Route: ' . $oInputInterface->getArgument('route') . "\n" . 'PID: ' . $iPid;
        nl(2);

        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------

$oSymfonyComponentConsoleApplication
    ->register('update')
    ->setAliases(['up'])
    ->setDescription(C_CYAN . "php emvicy update" . C_RESET . ' => updates: - Emvicy Framework and its vendor installed libraries, - vendor installed libraries of existing modules. requires: - Emvicy installed via `git clone` command, - bash, git')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::update();
        return Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('log')
    ->setDescription(C_CYAN . "php emvicy log 2023070711413964a7ddd36254a" . C_RESET . " => aggregates a unique log extract on STDOUT from all existing logfiles (*.log) matching to given logId `2023070711413964a7ddd36254a`")
    ->addArgument('id', InputArgument::REQUIRED)
    ->addArgument('nl', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::log(
            $oInputInterface->getArgument('id'),
            ((true === is_bool($oInputInterface->getArgument('nl')) ? $oInputInterface->getArgument('nl') : false))
        );
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# lint

$oSymfonyComponentConsoleApplication
    ->register('lint:all')
    ->setAliases(['la'])
    ->setDescription(C_CYAN . "php emvicy lint:all" . C_RESET . ' => checks the whole application on errors and returns a parsable JSON containing bool `bSuccess` and array `aMessage`.')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::lint();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('lint:module')
    ->setAliases(['lm'])
    ->setDescription(C_CYAN . "php emvicy lint:module Foo" . C_RESET . " => checks module `Foo` on errors and returns a parsable JSON containing bool `bSuccess` and array `aMessage`.")
    ->addArgument('module', InputArgument::REQUIRED)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::lint(
            $oInputInterface->getArgument('module')
        );
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# test

$oSymfonyComponentConsoleApplication
    ->register('test:module')
    ->setAliases(['t'])
    ->setDescription(C_CYAN . "php emvicy test:module modules/Foo/Test/" . C_RESET . ' => runs modules phpunit test in module `Foo`')
    ->addArgument('module', InputArgument::REQUIRED)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::test(
            '-c ' . $oInputInterface->getArgument('module')
        );
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# module

$oSymfonyComponentConsoleApplication
    ->register('module:add')
    ->setAliases(['mda'])
    ->setDescription(
        C_CYAN . "\tphp emvicy module:add Foo primary" . C_RESET . " => creates primary module `Foo`\n" .
        "\t\t\t\t\t" . C_CYAN . "php emvicy module:add Bar secondary" . C_RESET . " => creates secondary module `Bar`\n"
    )
    ->addArgument('sModule', InputArgument::REQUIRED)
    ->addArgument('sModuleType', InputArgument::REQUIRED)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {

        $sModuleType = $oInputInterface->getArgument('sModuleType');
        $bPrimary = (str_starts_with(strtolower(($sModuleType ?? '')), 'p')) ? true : false;

        Emvicy::moduleCreate(
            bForce: true,
            bPrimary: $bPrimary,
            sModule: $oInputInterface->getArgument('sModule')
        );
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('module:list')
    ->setAliases(['mdl'])
    ->setDescription(C_CYAN . "php emvicy module:list" . C_RESET . ' => lists available modules in JSON format. Example: {"SECONDARY":{"0":"Captcha","1":"DB","2":"Email","4":"Idolon","5":"InfoService","6":"OpenApi"},"PRIMARY":["Emvicy"]}')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::modules();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('module:controller')
    ->setAliases(['mdc'])
    ->setDescription(C_CYAN . "php emvicy module:controller Bar [?module]" . C_RESET . " => creates controller `Bar` in the primary module; optional in `module`. ")
    ->addArgument('sController', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::moduleCreateController(
            sController: $oInputInterface->getArgument('sController'),
            sModuleName: $oInputInterface->getArgument('sModuleName')
        );
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('module:model')
    ->setAliases(['mdm'])
    ->setDescription(C_CYAN . "php emvicy module:model Bar [?module]" . C_RESET . " => creates Model `Bar` in the primary module; optional in `module`. ")
    ->addArgument('sModel', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::moduleCreateModel(
            sModel: $oInputInterface->getArgument('sModel'),
            sModuleName: $oInputInterface->getArgument('sModuleName')
        );
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('module:view')
    ->setAliases(['mdv'])
    ->setDescription(C_CYAN . "php emvicy module:view Bar [?module]" . C_RESET . " => creates View `Bar` in the primary module; optional in `module`. ")
    ->addArgument('sView', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::moduleCreateView(
            sView: $oInputInterface->getArgument('sView'),
            sModuleName: $oInputInterface->getArgument('sModuleName')
        );
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# database

$oSymfonyComponentConsoleApplication
    ->register('db:table')
    ->setAliases(['dbt'])
    ->setDescription(C_CYAN . "php emvicy db:table Bar [?module]" . C_RESET . " => creates DB Table `Bar` in the primary module; optional in `module`. ")
    ->addArgument('sTable', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::dbCreateTableClass(
            sTable: $oInputInterface->getArgument('sTable'),
            sModuleName: $oInputInterface->getArgument('sModuleName')
        );
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('db:tableCollection')
    ->setAliases(['dbtc'])
    ->setDescription(C_CYAN . "php emvicy db:tableCollection Bar [?module]" . C_RESET . " => creates DB table collection class `Bar` in the primary module; optional in `module`. ")
    ->addArgument('sClass', InputArgument::REQUIRED)
    ->addArgument('sModuleName', InputArgument::OPTIONAL)
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::dbCreateTableClassCollection(
            sClass: $oInputInterface->getArgument('sClass'),
            sModuleName: $oInputInterface->getArgument('sModuleName')
        );
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# event

$oSymfonyComponentConsoleApplication
    ->register('event:list')
    ->setAliases(['el'])
    ->setDescription(C_CYAN . " php emvicy event:list" . C_RESET . " => lists all known event listeners in a markdown table")
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::eventListener();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# dynamic console menu extensions

if (false === empty(($GLOBALS['aConfig']['EMVICY_CONSOLE']) ?? []))
{
    foreach (\MVC\Arr::recursiveTrim($GLOBALS['aConfig']['EMVICY_CONSOLE']) as $aSet)
    {
        if (false === empty($aSet['register']) && false === $oSymfonyComponentConsoleApplication->has($aSet['register']))
        {
            $oSymfonyComponentConsoleApplication
                ->register($aSet['register'])
                ->setAliases($aSet['aliases'])
                ->setDescription($aSet['description'])
                ->addArgument($aSet['argumentName'], $aSet['argumentMode'])
                ->setCode($aSet['code']);
            ;
        }
    }
}

#-----------------------------------------------------------------------------------------------------------------------

try
{
    $oSymfonyComponentConsoleApplication->run();
}
catch (Exception $oException)
{
    echo "\n\n" . $oException->getMessage() . "\n\n";
}