<?php


namespace App\Table;

trait TraitAppTableGroup
{
    /**
     * @var \App\Table\Group
     */
    public Group $oAppTableGroup {get => $this->activate(__PROPERTY__);}
}
