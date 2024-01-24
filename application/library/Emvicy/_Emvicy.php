<?php


use MVC\Config;

$oSymfonyComponentConsoleApplication = new \Symfony\Component\Console\Application();
$oSymfonyComponentConsoleApplication->setName("\n" . 'Emvicy CLI Tool');

#---

$oSymfonyComponentConsoleApplication
    ->register('version')
    ->setAliases(['v'])
    ->setDescription('displays Emvicy version')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::version();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('serve')
    ->setAliases(['s'])
    ->setDescription('provides a local php server')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::serve();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('clearcache')
    ->setAliases(['cc'])
    ->setDescription('clears all contents of cache directory: - /application/cache/')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::clearcache();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('clearlog')
    ->setAliases(['cl'])
    ->setDescription('clears all contents of log directory: - /application/log/')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::clearlog();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('clearsession')
    ->setAliases(['cs'])
    ->setDescription('clears all contents of session directory: - /application/session/')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::clearsession();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('cleartemp')
    ->setAliases(['ct'])
    ->setDescription('clears all contents of templates_c directory: - /application/templates_c/')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::cleartemp();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('clearall')
    ->setAliases(['ca'])
    ->setDescription('clears all contents of temp directories: - `/application/cache/`, - /application/log/, - /application/session/, - /application/templates_c/')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::clearall();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('datatype:all')
    ->setAliases(['dt'])
    ->setDescription('creates datatype classes for all modules')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::datatype();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('datatype:module')
    ->setAliases(['dtm'])
    ->setDescription('creates datatype classes for a given module. Example: php emvicy dtm Foo')
    ->addArgument('module', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::datatype($oInputInterface->getArgument('module'));
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('routes:array')
    ->setAliases(['rt'])
    ->setDescription('lists available routes as array/var_export')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::routes();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('routes:json')
    ->setAliases(['rtj'])
    ->setDescription('lists available routes in JSON format')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::routes('json');
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('routes:list')
    ->setAliases(['rtl'])
    ->setDescription('lists available routes')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::routes('list');
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('update')
    ->setAliases(['up'])
    ->setDescription('updates: - Emvicy Framework and its vendor installed libraries, - vendor installed libraries of existing modules. requires: - Emvicy installed via `git clone` command, - bash, git')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::update();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('log')
    ->setDescription("aggregates a unique log extract on STDOUT from all existing logfiles (*.log) matching to given logId (=== MVC_UNIQUE_ID)
\t\t\tExamples:
\t\t\tphp emvicy log 2023070711413964a7ddd36254a    # aggregates a unique log extract
\t\t\tphp emvicy log 2023070711413964a7ddd36254a 0  # same
\t\t\tphp emvicy log 2023070711413964a7ddd36254a 1  # replaces newline \\n by a real linebreak")
    ->addArgument('id', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
    ->addArgument('nl', \Symfony\Component\Console\Input\InputArgument::OPTIONAL)
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::log(
            $oInputInterface->getArgument('id'),
            ((true === is_bool($oInputInterface->getArgument('nl')) ? $oInputInterface->getArgument('nl') : false))
        );
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('lint:all')
    ->setAliases(['l'])
    ->setDescription('checks the whole application on errors and returns a parsable JSON containing bool `bSuccess` and array `aMessage`.')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::lint();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('lint:module')
    ->setAliases(['lm'])
    ->setDescription("checks module on errors and returns a parsable JSON containing bool `bSuccess` and array `aMessage`.\n\t\t\tExample: php emvicy lm Foo")
    ->addArgument('module', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::lint(
            $oInputInterface->getArgument('module')
        );
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('test:module')
    ->setAliases(['t'])
    ->setDescription('runs modules phpunit test. Example: `php emvicy test:module modules/Foo/Test/`')
    ->addArgument('module', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::test(
            '-c ' . $oInputInterface->getArgument('module')
        );
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });

$oSymfonyComponentConsoleApplication
    ->register('module:create')
    ->setAliases(['mc'])
    ->setDescription("module creation.
\t\t\tprimary module creation
\t\t\t\tphp emvicy mc Foo p                     # creates primary module 'Foo'
\t\t\t\tphp emvicy module:create Foo primary    # creates primary module 'Foo'
\t\t\tsecondary module creation
\t\t\t\tphp emvicy mc Bar s                     # creates secondary module 'Bar'
\t\t\t\tphp emvicy module:create Foo secondary  # creates secondary module 'Bar'
    ")
    ->addArgument('sModule', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
    ->addArgument('sModuleType', \Symfony\Component\Console\Input\InputArgument::REQUIRED)
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {

        $sModuleType = $oInputInterface->getArgument('sModuleType');
        $bPrimary = (str_starts_with(strtolower(get($sModuleType, '')), 'p')) ? true : false;

        \Emvicy\Emvicy::create(
            bForce: true,
            bPrimary: $bPrimary,
            sModule: $oInputInterface->getArgument('sModule')
        );
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });
$oSymfonyComponentConsoleApplication
    ->register('module:list')
    ->setAliases(['md'])
    ->setDescription('lists available modules in JSON format. Example: {"SECONDARY":{"0":"Captcha","1":"DB","2":"Email","4":"Idolon","5":"InfoService","6":"OpenApi"},"PRIMARY":["Emvicy"]}')
    ->setCode(function (\Symfony\Component\Console\Input\InputInterface $oInputInterface, \Symfony\Component\Console\Output\OutputInterface $oOutputInterface): int {
        \Emvicy\Emvicy::modules();
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    });
#-----------------------------------------------------------------------------------------------------------------------

$oSymfonyComponentConsoleApplication->run();