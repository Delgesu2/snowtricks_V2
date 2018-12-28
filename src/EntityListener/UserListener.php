<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 26/12/18
 * Time: 22:57
 */

namespace App\EntityListener;

use App\Entity\Image;
use App\Entity\User;
use App\Utils\Uploader;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class UserListener
 *
 * @package App\EntityListener
 */
class UserListener
{
    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * @var Image
     */
    private $image;

    /**
     * UserListener constructor.
     * @param Uploader $uploader
     * @param Image $image
     */
    public function __construct(Uploader $uploader, Image $image)
    {
        $this->uploader = $uploader;
        $this->image = $image;
    }


    /**
     * @param User $user
     * @param Image $image
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(User $user,LifecycleEventArgs $eventArgs): void
    {
        $this->setUserAvatar($user);
    }

    /**
     *
     */
    public function setUserAvatar(User $user)
    {
        $user->setAvatar($this->image);
    }

}