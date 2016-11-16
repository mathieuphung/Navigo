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
            $formData = $form->getData();
            $user_exist = $this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findOneByName($formData->getName());
            if($user_exist) {
                $salt = uniqid(mt_rand(), true);
                $user_exist->setSalt($salt);
                $user_exist->setPassword(sha1($formData->getPassword().$salt));
                if($formData->getFile()) {
                    $user_exist->upload($formData->getFile());
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($user_exist);
                $em->flush();
                return $this->redirect($this->generateUrl('user_interface_homepage', array('name' => $user->getName())));
            }
            else {
                $message = 'Ce nom n\'est pas enregistré.';
                return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                    'form' => $form->createView(),
                    'message' => $message
                ));
            }
        }
        return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
