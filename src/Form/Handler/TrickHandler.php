<?php

namespace App\Form\Handler;
use App\Form\Type\Trick\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;

/**
 * Class TrickHandler
 * @package App\Form\Handler
 */
final class TrickHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * TrickHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function onSuccess(): void
    {
        if($this->entityManager->getUnitOfWork()->getEntityState($this->data) === UnitOfWork::STATE_NEW) {
            $this->entityManager->persist($this->data);
        }
        $this->entityManager->flush();
    }

    /**
     * @inheritdoc
     */
    public function getFormType(): string
    {
        return TrickType::class;
    }

}