<?php

namespace App\EntityListener;

use App\Entity\Comment;
use App\Entity\Trick;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class CommentTrickListener
 * Create new comment with TokenStorageInterface for author's name and DateTimeImmutable for date
 * @package App\EntityListener
 */
class CommentTrickListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CommentTrickListener constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Comment $comment
     * @param LifecycleEventArgs $eventArgs
     *
     * @throws \Exception
     */
    public function prePersist(
        Comment $comment,
        LifecycleEventArgs $eventArgs
    ): void
    {
        $comment->setCreatedAt(new \DateTimeImmutable());

        if($comment->getAuthor()) {
            return;
        }

        $comment->setAuthor($this->tokenStorage->getToken()->getUser());
    }

}