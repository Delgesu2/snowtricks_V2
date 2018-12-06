<?php

namespace App\EntityListener;

use App\Entity\Trick;
use App\Entity\User;
use App\Utils\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class RandomImageListener
 * Randomly select an image as main trick image for each page loading
 * @package App\EntityListener
 */
class RandomImageListener
{
    /**
     * @param Trick $trick
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(Trick $trick, LifecycleEventArgs $eventArgs): void
    {
        $trick->setMainImage($trick->getRandomImage()->getPath());
    }

    /**
     * @param Trick $trick
     * @param LifecycleEventArgs $eventArgs
     */
    public function preUpdate(Trick $trick, LifecycleEventArgs $eventArgs): void
    {
        $trick->setMainImage($trick->getRandomImage()->getPath());
    }

}