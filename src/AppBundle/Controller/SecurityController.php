<?php
 namespace AppBundle\Controller;
 
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
    
                
 class SecurityController extends Controller{
     
     /**
      * 
      * @param Request $request
      * @param AuthenticationUtils $authutils
      * @return \Symfony\Component\HttpFoundation\Response
      * 
      * @Route("/login",name="app_login")
      */
     
     public function loginAction(Request $request,AuthenticationUtils $authutils){
         
         $error = $authutils->getLastAuthenticationError();
         $lastUsername = $authutils->getLastUsername();
         
         return $this->render('AppBundle:Security:login.html.twig',array(
             'last_username' => $lastUsername,
             'error' => $error
         ));
         
     }
     
     
     /**
      * 
      * @param Request $request
      * 
      * @Route("/logout",name="app_logout")
      */
     public function logoutAction(Request $request){
         
     }
     
     
 }