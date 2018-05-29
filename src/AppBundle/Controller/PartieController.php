<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        return $this->render('AppBundle:Partie:show.html.twig', array(
            // ...
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
