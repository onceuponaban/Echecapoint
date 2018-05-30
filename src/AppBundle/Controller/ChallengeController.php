<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;

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
    public function createChallengeAction(){
        
    }

}
