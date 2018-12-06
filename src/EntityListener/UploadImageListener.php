<?php

namespace App\EntityListener;

use App\Entity\Image;
use App\Utils\Uploader;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class UploadImageListener
 * Image uploader helper listener
 * @package App\EntityListener
 */
class UploadImageListener
{
    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * UploadImageListener constructor.
     * @param Uploader $uploader
     */
    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param Image $image
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(Image $image, LifecycleEventArgs $eventArgs): void
    {
        $this->upload($image);
    }

    /**
     * @param Image $image
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function preUpdate(Image $image, LifecycleEventArgs $eventArgs): void
    {
        $this->upload($image);
    }

    /**
     * @param Image $image
     */
    private function upload(Image $image)
    {
        if($image->getUploadFile() === null) {
            return;
        }

        $image->setPath($this->uploader->upload($image->getUploadFile()));
    }
}