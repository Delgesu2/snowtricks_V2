<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Handler\EmailCheckHandler;
use App\Form\Model\Security\Login;
use App\Form\Type\Security\LoginType;
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
     * @Route("/login", name="security_login")
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
     * @param EmailCheckHandler $checkHandler
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function forget(
        EmailCheckHandler $checkHandler,
        Request $request
    )
    {
        if ($checkHandler->handle($user)) {

            $request->getSession()->getFlashBag()->add('Success', "Adresse vérifiée.
            Vérifiez votre boîte mail. Un courriel avec un lien de réinitialisation du mot de passe
             vous a été envoyé.");

            return $this->redirectToRoute('index');

            }

        return $this->render("security/email_check.html.twig", [
            "form" => $checkHandler->getView()
        ]);

    }

}
