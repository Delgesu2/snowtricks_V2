<?php

namespace App\Form\Handler;

use App\Entity\Image;
use App\Entity\User;
use App\Form\Type\Security\UpdateUserType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class RegisterHandler
 *
 * @package App\Form\Handler
 */
final class UpdateUserHandler extends AbstractHandler
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
        /**
        if($this->entityManager->getUnitOfWork()->getEntityState($this->data) === UnitOfWork::STATE_NEW) {

            $this->entityManager->persist($this->data);
        }
         * **/
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getFormType(): string
    {
        return UpdateUserType::class;
    }

}