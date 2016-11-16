<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignupController extends Controller
{
    public function signupAction()
    {
        return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                // ...
            ));    }

}
