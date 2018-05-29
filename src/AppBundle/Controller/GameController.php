<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GameController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Game:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/remove")
     */
    public function removeAction()
    {
        return $this->render('AppBundle:Game:remove.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/")
     */
    public function showAction()
    {
        return $this->render('AppBundle:Game:show.html.twig', array(
            // ...
        ));
    }

}
