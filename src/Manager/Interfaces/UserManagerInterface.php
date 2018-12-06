<?php

namespace App\Manager\Interfaces;
use App\Entity\User;

/**
 * Interface UserManagerInterface
 * @package App\Manager\Interfaces
 */
interface UserManagerInterface
{
    /**
     * @param User $user
     * persist user validation
     */
    public function validate(User $user): void;
}