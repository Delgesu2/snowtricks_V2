<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 16/12/18
 * Time: 21:53
 */

namespace App\Form\Handler;

use App\Entity\Image;
use App\Entity\User;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use App\Form\Type\Security\RegisterType;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class RegisterHandler
 *
 * @package App\Form\Handler
 */
final class RegisterHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * RegisterHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param User $user
     * @param Filesystem $filesystem
     * @param ImageRepository $repository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        User                   $user,
        Filesystem             $filesystem,
        ImageRepository        $repository
    )
    {
        $this->entityManager    = $entityManager;
        $this->user             = $user;
        $this->fileSystem       = $filesystem;
        $this->repository       = $repository;
    }


    /**
     * {@inheritdoc}
     */
    public function onSuccess(): void
    {
        if($this->entityManager->getUnitOfWork()->getEntityState($this->data) === UnitOfWork::STATE_NEW) {

            // Destroy old avatar
            if (!\is_null($this->user->getAvatar()) && !\is_null($this->form->getData()->avatar)) {

                // delete avatar file
                $this->fileSystem->remove($this->user->getAvatar());  // getPath()

                // delete avatar object
                $oldAvatar = $this->user->getAvatar();
                $this->repository->deleteUserAvatar($oldAvatar);

            }

            $this->entityManager->persist($this->data);
        }
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getFormType(): string
    {
        return RegisterType::class;
    }

}