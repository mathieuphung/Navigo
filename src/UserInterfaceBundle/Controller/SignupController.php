<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserInterfaceBundle\Entity\Users;
use UserInterfaceBundle\Form\UsersType;
use Symfony\Component\HttpFoundation\Request;

class SignupController extends Controller
{
    public function signupAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(new UsersType(), $user, array("action" => $this->generateUrl('signup')));
    
        if ($form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('notice', 'Vous êtes m\'intenant inscrit.');
        
            return $this->redirect($this->generateUrl('user_interface_homepage', array('name' => $user->getName())));
        }
        return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
