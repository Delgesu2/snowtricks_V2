<?php

namespace App\EntityListener;

use App\Entity\Trick;
use App\Entity\User;
use App\Utils\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class TimestampableTrickListener
 * @package App\EntityListener
 */
class TimestampableTrickListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * TimestampableTrickListener constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Trick $trick
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(Trick $trick, LifecycleEventArgs $eventArgs): void
    {
        $trick->setCreatedAt(new \DateTimeImmutable());

        if($trick->getCreatedBy()) {
            return;
        }

        $trick->setCreatedBy($this->tokenStorage->getToken()->getUser());
    }

    /**
     * @param Trick $trick
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function preUpdate(Trick $trick, LifecycleEventArgs $eventArgs): void
    {
        $trick->setUpdatedAt(new \DateTimeImmutable());
        $trick->setUpdatedBy($this->tokenStorage->getToken()->getUser());
    }

}