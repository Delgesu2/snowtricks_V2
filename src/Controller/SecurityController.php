<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Handler\EmailCheckHandler;
use App\Form\Handler\ResetPasswordHandler;
use App\Form\Model\Security\Login;
use App\Form\Type\Security\EmailCheckType;
use App\Form\Type\Security\LoginType;
use App\Form\Type\Security\ResetPasswordType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * Class SecurityController
 *
 * Sign in and using array as parameter (Exception and form)
 *
 * @package App\Controller
 *
 * @Route("/security")
 */
class SecurityController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * SecurityController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/login", name="security_login")
     *
     * Methods render() and createForm() from ControllerTrait used in AbstractController
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $login = new Login();
        $login->setUsername($authenticationUtils->getLastUsername());

        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form' => $this->createForm(LoginType::class, $login)->createView()
        ]);
    }


    /**
     * @Route("/forget", name="forget")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function forget(EmailCheckHandler $handler)
    {
        if ($handler->handle([])) {
            return $this->redirectToRoute('index');
        }

        return $this->render('security/email_check.html.twig', [
            'form' => $handler->getView()
        ]);

    }


    /**
     * @Route("/password_reset/{token}", name="password_reset")
     *
     * @ParamConverter("user", options={"mapping": {"token": "passwordToken"}})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @param User $user
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function passwordReset(
        User                 $user,
        ResetPasswordHandler $handler
    )
    {
        if ($handler->handle($user)) {
            return $this->redirectToRoute('index');
        }

        return $this->render('security/password_reset.html.twig', [
            'form' => $handler->getView()
        ]);
    }

    /**
     * @Route("/passwordchange", name="passwordchange")     *
     */
    public function passwordChange()
    {
       return $this->redirectToRoute('forget');
    }

}
