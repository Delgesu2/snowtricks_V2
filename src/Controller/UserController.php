<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\Interfaces\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/user")
 */
class UserController extends AbstractController
{
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
}
