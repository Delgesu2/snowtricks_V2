<?php

namespace App\Manager;

use App\Entity\User;
use App\Manager\Interfaces\UserManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserManager
 * Managing user through EntityManagerInterface
 * @package App\Manager
 */
class UserManager implements UserManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function validate(User $user): void
    {
        $user->setValidationToken(null);
        $user->setValidatedAt(new \DateTime());
        $this->entityManager->flush();
    }
}