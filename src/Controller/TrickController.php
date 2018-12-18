<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\Handler\TrickHandler;
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
     */
    public function delete(Trick $trick, Filesystem $filesystem)
    {
        return true;

        /**if (!\is_null($trick->getImages())) {

            $trick->removeImage($trick->getImages());
            $trick->removeVideo($trick->getVideos());


        }**/

    }
}
