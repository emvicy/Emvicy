<?php


namespace App\Table;

trait TraitAppTableQueue
{
    /**
     * @var \App\Table\Queue
     */
    public Queue $oAppTableQueue {get => $this->activate(__PROPERTY__);}
}
