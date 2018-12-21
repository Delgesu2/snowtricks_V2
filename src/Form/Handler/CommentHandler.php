<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 20/12/18
 * Time: 16:48
 */

namespace App\Form\Handler;

use App\Entity\Comment;
use App\Form\Type\Trick\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommentHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * CommentHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }


    /**
     * {@inheritdoc}
     */
    public function onSuccess(): void
    {
        if($this->entityManager->getUnitOfWork()->getEntityState($this->data) === UnitOfWork::STATE_NEW) {

         dump($this->form->getData());
         die;

            $this->entityManager->persist($this->data);
        }

        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getFormType(): string
    {
        return CommentType::class;
    }

}