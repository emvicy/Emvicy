<?php


use Emvicy\Emvicy;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

$sColCmd = "\033[0;36m";
$sColOff = "\033[0m";
#-----------------------------

$oSymfonyComponentConsoleApplication = new Application('Emvicy', '2.x');

#---

$oSymfonyComponentConsoleApplication
    ->register('version')
    ->setAliases(['v'])
    ->setDescription($sColCmd . "php emvicy version" . $sColOff . ' => displays Emvicy version')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::version();
        return Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('serve')
    ->setAliases(['s'])
    ->setDescription($sColCmd . "php emvicy serve" . $sColOff . ' => provides a local php-builtIn server')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::serve();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# cron

$oSymfonyComponentConsoleApplication
    ->register('cron:run')
    ->setAliases(['crr'])
    ->setDescription($sColCmd . "php emvicy cron:run" . $sColOff . ' => runs emvicy cron configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::cronrun();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('cron:list')
    ->setAliases(['crl'])
    ->setDescription($sColCmd . "php emvicy cron:list" . $sColOff . ' => list cron configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::cronlist();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# queue

$oSymfonyComponentConsoleApplication
    ->register('queue:list')
    ->setAliases(['ql'])
    ->setDescription($sColCmd . "php emvicy queue:list" . $sColOff . ' => list "Queue Key <=> Worker" configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::queueList();
        return Command::SUCCESS;
    });


#-----------------------------------------------------------------------------------------------------------------------
# policy

$oSymfonyComponentConsoleApplication
    ->register('policy:create')
    ->setAliases(['pc'])
    ->setDescription($sColCmd . "php emvicy policy:create Bar [?module]" . $sColOff . ' => creates a Policy class `Bar` in the primary module; optional in `module`. ')
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
    ->setDescription($sColCmd . "php emvicy policy:list" . $sColOff . ' => list available Policy configurations in a markdown table')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::policyList();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# worker

$oSymfonyComponentConsoleApplication
    ->register('worker:create')
    ->setAliases(['wc'])
    ->setDescription($sColCmd . "php emvicy worker:create Bar [?module]" . $sColOff . ' => creates a Worker class `Bar` in the primary module; optional in `module`. ')
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
    ->setDescription($sColCmd . "php emvicy worker:run" . $sColOff . ' => runs "Queue Key <=> Worker" configuration')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::workerRun();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# clear

$oSymfonyComponentConsoleApplication
    ->register('clear:cache')
    ->setAliases(['cc'])
    ->setDescription($sColCmd . "php emvicy clear:cache" . $sColOff . ' => clears all contents of cache directory: - /application/cache/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearcache();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:log')
    ->setAliases(['cl'])
    ->setDescription($sColCmd . "php emvicy clear:log" . $sColOff  . ' => clears all contents of log directory: - /application/log/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearlog();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:session')
    ->setAliases(['cs'])
    ->setDescription($sColCmd . "php emvicy clear:session" . $sColOff . ' => clears all contents of session directory: - /application/session/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearsession();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:temp')
    ->setAliases(['ct'])
    ->setDescription($sColCmd . "php emvicy clear:temp" . $sColOff . ' => clears all contents of templates_c directory: - /application/templates_c/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::cleartemp();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('clear:all')
    ->setAliases(['ca'])
    ->setDescription($sColCmd . "php emvicy clear:all" . $sColOff . ' => clears all contents of temp directories: - `/application/cache/`, - /application/log/, - /application/session/, - /application/templates_c/')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::clearall();
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------
# datatype

$oSymfonyComponentConsoleApplication
    ->register('datatype:all')
    ->setAliases(['dt'])
    ->setDescription($sColCmd . "php emvicy datatype:all" . $sColOff . ' => creates datatype classes for all modules')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::datatype();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('datatype:module')
    ->setAliases(['dtm'])
    ->setDescription($sColCmd . "php emvicy datatype:module Foo" . $sColOff . ' => creates datatype classes for module `Foo`')
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
    ->setDescription($sColCmd . "php emvicy routes:array" . $sColOff  . ' => lists available routes as array/var_export')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::routes();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('routes:json')
    ->setAliases(['rtj'])
    ->setDescription($sColCmd . "php emvicy routes:json" . $sColOff . ' => lists available routes in JSON format')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::routes('json');
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('routes:list')
    ->setAliases(['rtl'])
    ->setDescription($sColCmd . "php emvicy routes:list" . $sColOff . ' => lists available routes in a markdown table')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::routes('list');
        return Command::SUCCESS;
    });

#-----------------------------------------------------------------------------------------------------------------------

$oSymfonyComponentConsoleApplication
    ->register('update')
    ->setAliases(['up'])
    ->setDescription($sColCmd . "php emvicy update" . $sColOff . ' => updates: - Emvicy Framework and its vendor installed libraries, - vendor installed libraries of existing modules. requires: - Emvicy installed via `git clone` command, - bash, git')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::update();
        return Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('log')
    ->setDescription($sColCmd . "php emvicy log 2023070711413964a7ddd36254a" . $sColOff . " => aggregates a unique log extract on STDOUT from all existing logfiles (*.log) matching to given logId `2023070711413964a7ddd36254a`")
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
    ->setDescription($sColCmd . "php emvicy lint:all" . $sColOff . ' => checks the whole application on errors and returns a parsable JSON containing bool `bSuccess` and array `aMessage`.')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::lint();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('lint:module')
    ->setAliases(['lm'])
    ->setDescription($sColCmd . "php emvicy lint:module Foo" . $sColOff . " => checks module `Foo` on errors and returns a parsable JSON containing bool `bSuccess` and array `aMessage`.")
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
    ->setDescription($sColCmd . "php emvicy test:module modules/Foo/Test/" . $sColOff . ' => runs modules phpunit test in module `Foo`')
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
        $sColCmd . "\tphp emvicy module:add Foo primary" . $sColOff . " => creates primary module `Foo`\n" .
        "\t\t\t\t" . $sColCmd . "php emvicy module:add Bar secondary" . $sColOff . " => creates secondary module `Bar`\n"
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
    ->setDescription($sColCmd . "php emvicy module:list" . $sColOff . ' => lists available modules in JSON format. Example: {"SECONDARY":{"0":"Captcha","1":"DB","2":"Email","4":"Idolon","5":"InfoService","6":"OpenApi"},"PRIMARY":["Emvicy"]}')
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::modules();
        return Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('module:controller')
    ->setAliases(['mdc'])
    ->setDescription($sColCmd . "php emvicy module:controller Bar [?module]" . $sColOff . " => creates controller `Bar` in the primary module; optional in `module`. ")
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
    ->setDescription($sColCmd . "php emvicy module:model Bar [?module]" . $sColOff . " => creates Model `Bar` in the primary module; optional in `module`. ")
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
    ->setDescription($sColCmd . "php emvicy module:view Bar [?module]" . $sColOff . " => creates View `Bar` in the primary module; optional in `module`. ")
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
    ->setDescription($sColCmd . "php emvicy db:table Bar [?module]" . $sColOff . " => creates DB Table `Bar` in the primary module; optional in `module`. ")
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
    ->setDescription($sColCmd . "php emvicy db:tableCollection Bar [?module]" . $sColOff . " => creates DB table collection class `Bar` in the primary module; optional in `module`. ")
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
    ->setDescription($sColCmd . " php emvicy event:list" . $sColOff . " => lists all known event listeners in a markdown table")
    ->setCode(function (InputInterface $oInputInterface, OutputInterface $oOutputInterface): int {
        Emvicy::eventListener();
        return Command::SUCCESS;
    });
#-----------------------------------------------------------------------------------------------------------------------

try
{
    $oSymfonyComponentConsoleApplication->run();
}
catch (Exception $oException)
{
    echo "\n\n" . $oException->getMessage() . "\n\n";
}