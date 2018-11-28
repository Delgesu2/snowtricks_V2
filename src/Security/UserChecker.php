<?php

namespace App\Security;

use App\Exception\AccountUnvalidatedException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserChecker
 * @package App\Security
 */
class UserChecker implements UserCheckerInterface
{
    /**
     * @inheritdoc
     */
    public function checkPreAuth(UserInterface $user)
    {
        if($user->getValidatedAt() === null) {
            throw new AccountUnvalidatedException("Votre compte n'a pas été activé par un adminisrateur.");
        }
    }

    /**
     * @inheritdoc
     */
    public function checkPostAuth(UserInterface $user)
    {

    }
}