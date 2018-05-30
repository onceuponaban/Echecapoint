<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Entity\Game;
use AppBundle\Service\Board\Board;
use phpDocumentor\Reflection\Types\Integer;

class ChallengeController extends Controller
{
    /**
     * @Route("/Challenge", name="challenge")
     */
    public function ChallengeAction(Request $request)
    {
        $usersList = $this->getDoctrine()->getRepository(User::class)->findAll();
        
        return $this->render('AppBundle:Challenge:challenge.html.twig', array(
            'usersList' => $usersList
        ));
    }
    
    /**
     * @Route("/createChallenge",name="createChallenge")
     * 
     */
    public function createChallengeAction(Request $request){
        if($request->isMethod('post')){
            $game = new Game();
            
            $adId =intval($request->get('_opponent'));
            $opponent = $this->getDoctrine()->getRepository(User::class)->findOneById($adId);
            
            if($opponent!=null){
            if($request->get('_color')==1){
                $game->setWhitePlayer($this->getUser());
                $game->setBlackPlayer($opponent);
            }
            else{
                $game->setBlackPlayer($this->getUser());
                $game->setWhitePlayer($opponent);
            }
           
            $board = new Board(false);
            $strBrd=$board->toString();
            $game->setBoard($strBrd);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
           
           
            return $this->render('AppBundle:Challenge:challengeCreate.html.twig', array(
                'valid' => 1 ,
                'opponent' => $opponent->getUsername(),
                'gameId' => $game->getId()
            ));
            }
            
            else{
                return $this->render('AppBundle:Challenge:challengeCreate.html.twig', array(
                    'valid' => 0
                ));
            }
        }
        
        else{
            return $this->render('AppBundle:Challenge:challengeCreate.html.twig', array(
                'valid' => 0
            ));
            
        }
        
    }

}
