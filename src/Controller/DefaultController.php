<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\Handler\CommentHandler;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * going to Homepage
     *
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
     *
     * @Route("/trick-{slug}", name="show")
     *
     * @param Trick $trick
     * @param CommentHandler $handler
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Trick $trick, CommentHandler $handler)
    {
        if ($handler->handle(new Comment())) {
            return $this->render('default/selected_trick.html.twig', [
                'trick' => $trick,
                'form'  => $handler->getView()
            ]);
        }

        return $this->render('default/selected_trick.html.twig', [
            'trick' => $trick,
            'form'  => $handler->getView()
        ]);
    }

    /**
     * going to full tricks list
     *
     * @Route("/list", name="list")
     */
    public function trickList(TrickRepository $repository)
    {
        return $this->render('default/tricks.html.twig', [
            'trick' => $repository->findAll()
        ]);
    }

}
