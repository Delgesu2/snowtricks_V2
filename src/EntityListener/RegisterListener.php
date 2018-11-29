<?php

namespace App\EntityListener;

use App\Entity\User;
use App\Utils\Mailer;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class RegisterListener
 * @package App\EntityListener
 */
class RegisterListener
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * RegisterListener constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(User $user, LifecycleEventArgs $eventArgs)
    {
        $user->setValidationToken(uniqid(mt_rand(), true));
    }

    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function postPersist(User $user, LifecycleEventArgs $eventArgs)
    {
        $this->mailer->sendValidation($user);
    }
}