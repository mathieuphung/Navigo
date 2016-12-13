<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if ($user === null) {
            return $this->render('UserInterfaceBundle:Default:index.html.twig');
        } else {
            return $this->render('UserInterfaceBundle:Default:index.html.twig', array(
                'name' => explode(' ',$user->getName())[1],
                'user' => $user,
            ));
        }
    }
}
