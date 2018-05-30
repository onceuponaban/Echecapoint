<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Game;
use AppBundle\Service\Board\Board;

/**
 * @Route("/game")
 */
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
     * @Route("/remove/{id}", requirements={"id": "\d+"}, name="app_game_remove")
     */
    public function removeAction()
    {
        return $this->render('AppBundle:Game:remove.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, name="app_game_show")
     */
    public function showAction(int $id)
    {
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);
        
        $board = new Board(false);
        
        return $this->render('AppBundle:Game:show.html.twig', array(
            'board' => $board->updateFromString($game->getBoard())
        ));
    }

}
