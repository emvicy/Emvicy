<?php


namespace App\Table;

trait TraitAppTableUser
{
    /**
     * @var \App\Table\User
     */
    public User $oAppTableUser {get => $this->activate(__PROPERTY__);}
}
