<?php

namespace MVC;

use App\DataType\DTAppTableQueue;
use MVC\DataType\DTDBWhere;
use MVC\DataType\DTDBWhereRelation;

class Worker
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getConfig() : array
    {
        return (Config::MODULE()['queue']['worker'] ?? array());
    }

    /**
     * Fetches X jobs from the queue and starts the responsible workers async
     * @return bool
     * @throws \ReflectionException
     */
    public static function run(): bool
    {
        // get configs
        $aWorkerConfig = self::getConfig();
        $sWorkerConfigKeys = '"' . implode('","', array_keys(array_filter($aWorkerConfig))) . '"';
        $sQueueWorkerAutoRoutePrefix = Config::get_MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX();

        if (true === empty($sQueueWorkerAutoRoutePrefix))
        {
            return false;
        }

        // Number of processes still available
        $iAmountProcessesAvailable = Process::getAmountProcessesAvailable();

        // only continue if free processes are available
        if ($iAmountProcessesAvailable > 0)
        {
            // only fetch the next X jobs (=== number of processes still available) from the queue for which there are also workers
            $aDTAppTableQueue = Queue::next(
                $iAmountProcessesAvailable,
                array(
                    DTDBWhere::create()
                        ->set_sKey(DTAppTableQueue::getPropertyName_key())
                        ->set_sRelation(DTDBWhereRelation::In)
                        ->set_sValue($sWorkerConfigKeys)
                )
            );

            // Start time; measure total processing time
            $iStart = time();

            // Maximum number of parallel processes
            $iMaxProcessesParallel = Config::get_MVC_PROCESS_MAX_PROCESSES_OVERALL();

            // Number of routes to be called up
            $iAmountRoute = count($aDTAppTableQueue);

            // Counter
            $iIteration = 0;
            $iProcessCounter = 0;

            // Loop
            while($iIteration < $iAmountRoute)
            {
                // Number of available processes
                $iAmountProcessesAvailable = Process::getAmountProcessesAvailable();

                // No free processes
                if (0 === $iAmountProcessesAvailable)
                {
                    Process::pause(iSeconds: 3, sPreText: "\t· max Amount of Processes reached: " . $iMaxProcessesParallel);
                    $iProcessCounter = 0;
                }
                // Process free; processing can take place
                else
                {
                    $oDTAppTableQueue = $aDTAppTableQueue[$iIteration];

                    // call worker via autoRoute async (non-blocking)
                    $sRoute = $sQueueWorkerAutoRoutePrefix . '/' . $oDTAppTableQueue->get_key() . '/' . $oDTAppTableQueue->get_id();
                    $iPid = Process::callRoute($sRoute);

                    // worked, there is a PID
                    if (false === empty($iPid))
                    {
                        // save pidfile
                        Process::savePid($iPid, $oDTAppTableQueue);

                        Event::run('mvc.worker.after',
                            'pid: ' . $iPid .
                            ', started: ' .  count(Process::getRunningPidFileArray()) .
                            ', free: ' . Process::getAmountProcessesAvailable() .
                            ' | id: ' . $oDTAppTableQueue->get_id() . "\t" . $sRoute
                        );

                        $iIteration++;
                        $iProcessCounter++;
                    }
                }

                if ($iProcessCounter === $iMaxProcessesParallel)
                {
                    Process::pause(iSeconds: 3, sPreText: "\t· max Amount of Processes reached: " . $iMaxProcessesParallel);
                    $iProcessCounter = 0;
                }

                if ((time() - $iStart) >= Config::get_MVC_QUEUE_RUNTIME_SECONDS())
                {
                    break;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Build from `etc/config/{module}/config/_queue.php` Queue Keys Auto-Routes
     * to be called from `etc/routing/queue.php`
     * @return bool
     * @throws \ReflectionException
     */
    public static function workerAutoRoute(): bool
    {
        // get worker config
        $aWorker = self::getConfig();
        $sRoutePrefix = Config::get_MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX();

        if (true === empty($sRoutePrefix))
        {
            return false;
        }

        // walk worker config
        foreach ($aWorker as $sQueueKey => $sWorkerClassMethod)
        {
            // skip
            if (true === empty($sQueueKey) || true === empty($sWorkerClassMethod))
            {
                continue;
            }

            // add individual route for worker
            $sRoute = $sRoutePrefix . '/' . $sQueueKey . '/*';

            Route::GET(
                sPath: $sRoute,
                sClassMethod: Config::get_MVC_QUEUE_WORKER_AUTO_ROUTE_RESOLVE_CLASSMETHOD()
            );
        }

        return true;
    }
}