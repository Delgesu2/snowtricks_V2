<?php

namespace App\EntityListener;

use App\Entity\User;
use App\Utils\Uploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;

/**
 * Class UploadUserListener
 *
 * User uploader helper listener
 *
 * @package App\EntityListener
 */
class UploadAvatarListener
{
    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * UploadAvatarListener constructor.
     *
     * @param Uploader $uploader
     * @param Filesystem $filesystem
     */
    public function __construct(
        Uploader   $uploader,
        Filesystem $filesystem
    )
    {
        $this->uploader   = $uploader;
        $this->filesystem = $filesystem;
    }

    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function prePersist(User $user, LifecycleEventArgs $eventArgs): void
    {
        $this->upload($user);
    }

    /**
     * @param User $user
     * @param LifecycleEventArgs $eventArgs
     * @throws \Exception
     */
    public function preUpdate(User $user, LifecycleEventArgs $eventArgs): void
    {
       // $user->setAvatar(null);
        //$eventArgs->getEntityManager()->flush();
       // $eventArgs->getEntityManager()->remove($user->getAvatar());  réclame un objet
      //  $this->filesystem->remove('uploads/' . $user->getAvatar());

        $this->upload($user);
    }

    /**
     * @param User $user
     */
    private function upload(User $user)
    {
        if($user->getUploadFile() === null) {
            return;
        }

        $user->setAvatar($this->uploader->upload($user->getUploadFile()));

    }
}