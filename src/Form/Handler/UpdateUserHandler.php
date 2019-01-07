<?php

namespace App\Form\Handler;

use App\Entity\Image;
use App\Entity\User;
use App\Form\Type\Security\UpdateUserType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param Filesystem $filesystem
     * @param ImageRepository $repository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        Filesystem             $filesystem,
        ImageRepository        $repository
    )
    {
        $this->entityManager    = $entityManager;
        $this->fileSystem       = $filesystem;
        $this->repository       = $repository;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function onSuccess(): void
    {
        if (!\is_null($this->form->getData()->getUploadFile())) {
            $this->fileSystem->remove('uploads/' . $this->data->getAvatar());
        }

        $this->data->setUpdatedAt(new \DateTimeImmutable());

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