<?php

namespace App\EntityListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class HashPasswordListener
 * @package App\EntityListener
 */
class HashPasswordListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * HashPasswordListener constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }


    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(User $user, LifecycleEventArgs $eventArgs): void
    {
        $user->setSalt(uniqid(mt_rand(), true));

        $this->encodePassword($user);
    }

    /**
     * @param User $user
     * @throws \Exception
     */
    private function encodePassword(User $user)
    {
        if($user->getPlainPassword() === null) {
            return;
        }

        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword()));
        $user->setPlainPassword(null);
        $user->setPasswordRequestedAt(null);
        $user->setPasswordToken(null);
        $user->setPasswordUpdatedAt(new \DateTimeImmutable());
    }
}