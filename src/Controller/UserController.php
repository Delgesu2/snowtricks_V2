<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Handler\RegisterHandler;
use App\Form\Handler\UpdateUserHandler;
use App\Form\Type\Security\RegisterType;
use App\Manager\Interfaces\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserController
 *
 * Validate sign up
 *
 * @package App\Controller
 *
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * UserController constructor.
     *
     * @param TokenStorageInterface
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    /**
     * @Route("/validate/{token}", name="user_validate")
     * @ParamConverter("user", options={"mapping": {"token": "validationToken"}})
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function validate(User $user, UserManagerInterface $userManager)
    {
        $userManager->validate($user);

        return $this->redirectToRoute("security_login");
    }


    /**
     * Create new User
     *
     * @Route("/register", name="register")
     *
     * @param RegisterHandler $handler
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function register(RegisterHandler $handler)
    {
        if ($handler->handle(new User())) {
            return $this->redirectToRoute('index');
        }

        return $this->render('user/register.html.twig', [
            'form' => $handler->getView()
        ]);
    }

    /**
     *  Update User
     *
     * @Route("/update", name="user_update")
     *
     * @param UpdateUserHandler $handler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function update(UpdateUserHandler $handler)
    {
        $user = $this->tokenStorage->getToken()->getUser();

        if ($handler->handle($user)) {
            return $this->redirectToRoute('index');
        }

        return $this->render('user/updateuser.html.twig', [
            'form' => $handler->getView()
        ]);
    }

}
