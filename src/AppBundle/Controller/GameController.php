<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Game;
use AppBundle\Service\Board\Board;
use AppBundle\Service\Board\BoardCoordinates;
use AppBundle\Service\Pieces\Pawn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        
        $board->updateFromString($game->getBoard());
        
        return $this->render('AppBundle:Game:show.html.twig', array(
            'game' => $game,
            'board' => $board
        ));
    }
    
    /**
     * @Route("/possiblemove", name="app_list_move")
     */
    public function listMoveAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $id = $request->get('id');
            
            $file = $request->get('file');
            
            $rank = $request->get('rank');
            
        }else
        {
            $id = (isset($_GET["id"])) ? $_GET["id"] : NULL;
            
            $file = (isset($_GET["file"])) ? $_GET["file"] : NULL;
            
            $rank = (isset($_GET["rank"])) ? $_GET["rank"] : NULL;
        }
        
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);
        
        $board = new Board(false);
        
        $board->updateFromString($game->getBoard());
        
        $coordinates = new BoardCoordinates($file, $rank);
        
        $piece = $board->pieceAt($coordinates);
        
        $moveList = $board->getPossibleMovesOf($piece);
        
        $stringMove = array();
        
        if(count($moveList) != 0)
        {
            
            foreach ($moveList as $move)
            {
                array_push($stringMove, $move->getCoordinates()->getFile().$move->getCoordinates()->getRank());
            }
            
        }
        
        return new JsonResponse(array('moves' => json_encode($stringMove)));

    }

}
