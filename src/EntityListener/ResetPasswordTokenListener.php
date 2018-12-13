<?php

namespace App\EntityListener;


use App\Utils\Mailer;

class ResetPasswordTokenListener
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
    }

}