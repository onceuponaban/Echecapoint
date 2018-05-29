<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(\AppBundle\Form\RegistrationType::class, $user);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $salt = $this->kodex_random_string(40);
            $user->setSalt($salt);
            
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
           
            $user->setPassword($password);
            $this->initUser($user);
            $user->setRoles(array('ROLE_USER'));
            
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render(
            'AppBundle:Registration:register.html.twig',
            array('form' => $form->createView())
            );
        
    }
    
    public function initUser(User $User){
        $User->setNbPartiesGagnees(0);
        $User->setNbPartiesJouees(0);
        $User->setNbPtsLaisses(0);
        $User->setNbPtsTotal(0);
    }
    
    private function kodex_random_string($length=40){
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/+';
        $string = '';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
        }
        return $string;
    }
}
