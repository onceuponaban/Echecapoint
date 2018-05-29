<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Partie;
use AppBundle\Service\Board\Board;

/**
 * @Route("/partie")
 */
class PartieController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Partie:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function showAction(int $id)
    {
        
        $partie = $this->getDoctrine()->getRepository(Partie::class)->find($id);
        
        $plateau = new Board();
        
        return $this->render('AppBundle:Partie:show.html.twig', array(
            'plateau' => $plateau->updateFromString($partie->getPlateau())
        ));
    }

    /**
     * @Route("/remove/{id}", requirements={"id": "\d+"})
     */
    public function removeAction(int $id)
    {
        return $this->render('AppBundle:Partie:remove.html.twig', array(
            // ...
        ));
    }

}
