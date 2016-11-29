<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
    
        if (null === $user) {
            return $this->render('UserInterfaceBundle:Default:index.html.twig');
        } else {
            return $this->render('UserInterfaceBundle:Default:index.html.twig', array(
                'name' => explode(' ',$user->getUsername())[1]
            ));
        }
    }
}
