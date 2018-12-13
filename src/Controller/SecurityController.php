<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Handler\EmailCheckHandler;
use App\Form\Model\Security\Login;
use App\Form\Type\Security\EmailCheckType;
use App\Form\Type\Security\LoginType;
use App\Form\Type\Security\RegisterType;
use App\Form\Type\Security\ResetPasswordType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 *
 * Sign in and using array as parameter (Exception and form)
 *
 * @package App\Controller
 * @Route("/security")
 */
class SecurityController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var Request
     */
    private $request;

    /**
     * SecurityController constructor.
     *
     * @param UserRepository $repository
     * @param Request $request
     */
    public function __construct(
        UserRepository $repository,
        Request        $request
    )
    {
        $this->repository = $repository;
        $this->request    = $request;
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
     */
    public function forget()
    {
        return $this->render('security/email_check.html.twig', [
            'form' => $this->createForm(EmailCheckType::class)->createView()
        ]);

    }


    /**
     * @Route("/password_reset/{token}", name="password_reset")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function passwordReset()
    {
        // check if token exists in database
        $user = $this->repository->checkToken($this->request->attributes->get('token'));

        if ($user) {

            return $this->render('security/password_reset.html.twig', [
                'form' => $this->createForm(ResetPasswordType::class)->createView()
            ]);

        }

        // if token does not exist in database
        return $this->redirectToRoute('index');
    }


    /**
     * @Route("/register", name="register")
     */
    public function register()
    {
        return $this->render('security/register.html.twig', [
            'form' => $this->createForm(RegisterType::class)->createView()
        ]);
    }

}
