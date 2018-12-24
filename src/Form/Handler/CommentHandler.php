<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 20/12/18
 * Time: 16:48
 */

namespace App\Form\Handler;

use App\Entity\Comment;
use App\Entity\Trick;
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
     * @var Trick
     */
    private $trick;


    /**
     * CommentHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param Trick $trick
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        Trick                  $trick
    )
    {
        $this->entityManager = $entityManager;
        $this->trick         = $trick;
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
        return CommentType::class;
    }

}