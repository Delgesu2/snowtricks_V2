<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * going to Homepage
     * @Route("/", name="index")
     */
    public function index(TrickRepository $repository)
    {
        return $this->render('default/home.html.twig', [
            'tricks' => $repository->findAll()
        ]);
    }

    /**
     * going to selected trick page
     * @Route("/trick-{slug}", name="show")
     */
    public function show(Trick $trick)
    {
        return $this->render('default/selected_trick.html.twig', [
            'trick' => $trick
        ]);
    }

    /**
     * going to full tricks list
     * @Route("/list", name="list")
     */
    public function trickList(TrickRepository $repository)
    {
        return $this->render('default/tricks.html.twig', [
            'trick' => $repository->findAll()
        ]);
    }

}
