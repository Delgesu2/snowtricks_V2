<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 14/12/18
 * Time: 00:12
 */

namespace App\Form\Handler;


use App\Entity\User;
use App\Form\Type\Security\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class ResetPasswordHandler extends AbstractHandler
{
    /**
     * @var User
     */
    private $user;



    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ResetPasswordHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface       $entityManager
    )
    {
        $this->entityManager       = $entityManager;
    }


    /**
     *
     */
    public function onSuccess(): void
    {
        $this->entityManager->flush();
    }


    public function getFormType(): string
    {
        return ResetPasswordType::class;
    }
}