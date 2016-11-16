<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        if($name) return $this->render('UserInterfaceBundle:Default:index.html.twig', array('name' => $name));
    
        return $this->render('UserInterfaceBundle:Default:index.html.twig');
    }
}
