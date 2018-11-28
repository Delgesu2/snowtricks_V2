<?php

namespace App\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class AccountUnvalidatedException
 * @package App\Exception
 */
class AccountUnvalidatedException extends AuthenticationException
{
    /**
     * @inheritdoc
     */
    public function getMessageKey()
    {
        return "Account not activated.";
    }

}