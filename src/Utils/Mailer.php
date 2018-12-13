<?php

namespace App\Utils;
use App\Entity\User;
use Twig\Environment;

/**
 * Class Mailer
 * using SwiftMailer, transport and message.
 * @package App\Utils
 */
class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendValidation(User $user)
    {
        $message = new \Swift_Message();

        $message
            ->setSender("contact@devxdemo.eu", "Snowtricks")
            ->setSubject("Bienvenue sur Snowtricks")
            ->setReplyTo("contact@devxdemo.eu", "Snowtricks - Contact")
            ->setTo($user->getEmail(), $user->getUserName())
            ->setBody(
                $this->twig->render("user/invitation_email.html.twig", ["user" => $user]),
                "text/html"
            )
        ;

        $this->mailer->send($message);
    }

    /**
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendNewToken(User $user)
    {
        $message = new \Swift_Message();

        $message
            ->setSender("contact@devxdemo.eu", "Snowtricks")
            ->setSubject("Oubli du mot de passe. Réinitialisation")
            ->setReplyTo("contact@devxdemo.eu", "Snowtricks - Contact")
            ->setTo($user->getEmail(), $user->getUserName())
            ->setBody(
               $this->twig->render("user/password_reset_email.html.twig", ["user" => $user]),
                "text/html"
            )
        ;

        $this->mailer->send($message);
    }

}