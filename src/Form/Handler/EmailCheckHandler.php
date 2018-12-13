<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 05/12/18
 * Time: 19:30
 */

namespace App\Form\Handler;

use App\Entity\User;
use App\Form\Type\Security\EmailCheckType;
use App\Repository\UserRepository;
use App\Utils\Mailer;
use Symfony\Component\Form\FormInterface;

final class EmailCheckHandler extends AbstractHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Mailer
     */
    private $mailer;

    /**+
     * EmailCheckHandler constructor.
     *
     * @param UserRepository $repository
     * @param User $user
     * @param Mailer $mailer
     */
    public function __construct(
        UserRepository    $repository,
        User              $user,
        Mailer            $mailer
    )
    {
        $this->repository = $repository;
        $this->user       = $user;
        $this->mailer     = $mailer;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function onSuccess(): void
    {
        $oneUser = $this->repository->findOneByEmail();

        // create and save new token in User
        $this->user->setValidationToken(uniqid(mt_rand(), true));
        $this->repository->save($oneUser);  // mouaif .....

        // sending token to User mail address
        $this->mailer->sendNewToken($oneUser);
    }

    public function getFormType(): string
    {
        return EmailCheckType::class;
    }
}