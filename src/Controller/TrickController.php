<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\Handler\TrickHandler;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class TrickController
 * @package App\Controller
 * @Route("/tricks")
 * @IsGranted("ROLE_USER") *
 */
class TrickController extends AbstractController
{
    /**
     * checking form completion, then leading to homepage. If not, load empty form.
     *
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
     * checking form completion, then leading to homepage. If not, load form for editing.
     *
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

    /**
     * deleting Trick
     *
     * @Route("/{slug}/delete", name="trick_delete")
     *
     * @param Trick $trick
     * @param Filesystem $filesystem
     * @param TrickRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(
        Trick           $trick,
        Filesystem      $filesystem,
        TrickRepository $repository
    )
    {
        // delete file
        if (!\is_null($trick->getImages())) {

           foreach ($trick->getImages()->toArray() as $image)
           {
               $filesystem->remove('uploads/' . $image->getPath());
           }

        }

        // delete object
        $repository->deleteTrick($trick);

        return $this->redirectToRoute('list');
    }
}
