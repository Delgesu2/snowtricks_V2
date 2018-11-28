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
     * @Route("/", name="index")
     */
    public function index(TrickRepository $repository)
    {
        return $this->render('default/index.html.twig', [
            'tricks' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/trick-{slug}", name="show")
     */
    public function show(Trick $trick)
    {
        return $this->render('default/show.html.twig', [
            'trick' => $trick
        ]);
    }

}
