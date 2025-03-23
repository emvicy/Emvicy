<?php

namespace App\Controller;

use App\Controller;
use MVC\Config;
use MVC\DataType\DTRequestIn;
use MVC\DataType\DTRoute;
use MVC\Event;
use MVC\Http\Status_Forbidden_403;
use MVC\Lock;
use MVC\Request;
use MVC\RequestHelper;
use MVC\Route;
use MVC\Worker;

class Queue extends Controller
{
    public function __construct(DTRequestIn $oDTRequestIn, DTRoute $oDTRoute)
	{
        parent::__construct($oDTRequestIn, $oDTRoute);

        if (false === Request::in()->get_isCli())
        {
            RequestHelper::redirect(
                sLocation: Route::getOnTag('403')->get_path(),
                iResponseCode: Status_Forbidden_403::CODE
            );
        }

        // toolbar off
        Config::set_MVC_INFOTOOL_ENABLE();
	}

    /**
     * starts worker on queue jobs
     * @param \MVC\DataType\DTRequestIn $oDTRequestIn
     * @param \MVC\DataType\DTRoute     $oDTRoute
     * @return void
     * @throws \ReflectionException
     */
    public function workerRun(DTRequestIn $oDTRequestIn, DTRoute $oDTRoute): void
    {
        Lock::create();
        Worker::run();
    }

    /**
     * This is where all `/_mvc/queue/worker/{Queue::Key}/*` auto-routes point to
     * @see modules/{module}/etc/routing/queue.php
     *      modules/{module}/etc/config/{module}/config/_queue.php
     * @param \MVC\DataType\DTRequestIn $oDTRequestIn
     * @param \MVC\DataType\DTRoute     $oDTRoute
     * @return bool
     * @throws \ReflectionException
     */
    public function workerAutoRouteResolve(DTRequestIn $oDTRequestIn, DTRoute $oDTRoute): bool
    {
        $sQueueWorkerAutoRoutePrefix = Config::get_MVC_QUEUE_WORKER_AUTO_ROUTE_PREFIX();

        if (true === empty($sQueueWorkerAutoRoutePrefix))
        {
            return false;
        }

        // extract Queue key; is always transferred
        $sQueueKey = strtok(substr($oDTRoute->get_path(), strlen($sQueueWorkerAutoRoutePrefix)), '/');

        // if a concrete queue JobID was also transferred as `_tail`; `/queue/worker/{Queue::Key}/*`
        $iIdQueue = preg_replace('/[^[:digit:]\\-]/ui', '', Request::in()->get_pathParamArray()['_tail']);

        // get worker config
        $aWorkerConfig = Worker::getConfig();

        // class
        $sWorkerClass = ($aWorkerConfig[$sQueueKey] ?? null);

        // skip on no worker class
        if (true === empty($sWorkerClass))
        {
            return false;
        }

        // @see \MVC\WorkerTrait
        $sWorkerClassConcreteJob = $sWorkerClass . '::concreteJob';
        $sWorkerClassNextJob = $sWorkerClass . '::nextJob';

        // call Worker with concrete queue job (id)
        if (false === empty($iIdQueue))
        {
            Event::run('app.controller.queue.worker', 'pid: ' . getmypid() . ', id: ' . $iIdQueue . "\t" . $sWorkerClassConcreteJob);

            // call worker with queue key
            $sWorkerClassConcreteJob($iIdQueue);
        }
        // call Worker (he takes a job for himself)
        elseif (true === is_callable($sWorkerClassNextJob))
        {
            Event::run('app.controller.queue.worker', 'pid: ' . getmypid() . ', key: ' . $sQueueKey . "\t" . $sWorkerClassNextJob);

            // call worker with queue key
            $sWorkerClassNextJob($sQueueKey);
        }

        return true;
    }

    /**
     * @throws \ReflectionException
     */
    public function __destruct()
    {
        parent::__destruct();
        Event::run('app.controller.queue.__destruct');
    }
}