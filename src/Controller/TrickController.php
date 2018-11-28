<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\Handler\TrickHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class TrickController
 * @package App\Controller
 * @Route("/tricks")
 * @IsGranted("ROLE_USER")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/add", name="trick_add")
     */
    public function add(TrickHandler $trickHandler)
    {
        if($trickHandler->handle(new Trick())) {
            return $this->redirectToRoute('index');
        }

        return $this->render("trick/edit.html.twig", [
            "form" => $trickHandler->getView()
        ]);
    }


    /**
     * @Route("/{slug}/update", name="trick_update")
     */
    public function update(TrickHandler $trickHandler, Trick $trick)
    {
        if($trickHandler->handle($trick)) {
            return $this->redirectToRoute('index');
        }

        return $this->render("trick/edit.html.twig", [
            "form" => $trickHandler->getView()
        ]);
    }
}
