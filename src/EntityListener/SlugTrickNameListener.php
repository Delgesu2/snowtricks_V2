<?php

namespace App\EntityListener;

use App\Entity\Trick;
use App\Entity\User;
use App\Utils\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class SlugTrickNameListener
 * Creating trick's slug from name
 * @package App\EntityListener
 */
class SlugTrickNameListener
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
     * @param Trick $trick
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(Trick $trick, LifecycleEventArgs $eventArgs): void
    {
        $trick->setSlug($this->slugify::transform($trick->getName()));
    }

    /**
     * @param Trick $trick
     * @param LifecycleEventArgs $eventArgs
     */
    public function preUpdate(Trick $trick, LifecycleEventArgs $eventArgs): void
    {
        $trick->setSlug($this->slugify::transform($trick->getName()));
    }

}