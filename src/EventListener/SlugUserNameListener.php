<?php

namespace App\EventListener;

use App\Entity\User;
use App\Utils\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class SlugUserNameListener
 * @package App\EventListener
 */
class SlugUserNameListener
{
    /**
     * @var Slugify
     */
    private $slugify;

    /**
     * SlugUserNameListener constructor.
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(User $user, LifecycleEventArgs $eventArgs): void
    {
        $user->setSlug($this->slugify::transform($user->getUserName()));
    }

    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function preUpdate(User $user, LifecycleEventArgs $eventArgs): void
    {
        $user->setSlug($this->slugify::transform($user->getUserName()));
    }

}