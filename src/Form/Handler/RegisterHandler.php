<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 16/12/18
 * Time: 21:53
 */

namespace App\Form\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use App\Form\Type\Security\RegisterType;

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
     * RegisterHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * {@inheritdoc}
     */
    public function onSuccess(): void
    {
        if($this->entityManager->getUnitOfWork()->getEntityState($this->data) === UnitOfWork::STATE_NEW) {
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