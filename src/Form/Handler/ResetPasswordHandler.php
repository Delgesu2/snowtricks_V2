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
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class ResetPasswordHandler extends AbstractHandler
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * ResetPasswordHandler constructor.
     *
     * @param FormInterface $form
     * @param User $user
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param UserRepository $repository
     */
    public function __construct(
        FormInterface                $form,
        User                         $user,
        UserPasswordEncoderInterface $userPasswordEncoder,
        UserRepository               $repository
    )
    {
        $this->form                = $form;
        $this->user                = $user;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->repository          = $repository;
    }


    /**
     * @throws \Exception
     */
    public function onSuccess(): void
    {
        if ($this->form->getData()->password === $this->form->getData()->password2 ) {

            $this->user->setSalt(uniqid(mt_rand(), true));

            $this->user->setPassword($this->userPasswordEncoder->encodePassword($this->user, $this->user->getPlainPassword()));
            $this->user->setPlainPassword(null);
            $this->user->setPasswordRequestedAt(null);
            $this->user->setPasswordToken(null);
            $this->user->setPasswordUpdatedAt(new \DateTimeImmutable());

            $this->repository->save($this->user);

        }


    }

    public function getFormType(): string
    {
        return ResetPasswordType::class;
    }
}