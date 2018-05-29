<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Game;

class DashboardController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/dashboard",name="dashboard")
     * @param Request $request
     */
    public function displayGamesAction(Request $request){
        $user = $this->getUser();     
           
        return $this->render('AppBundle:Index:dashboard.html.twig',array(
            'BlackGames' => $user->getPartieNoire(),
            'WhiteGames' => $user->getPartieBlanche()
        ));
        
        
    }
    
}

