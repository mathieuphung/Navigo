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
            $em = $this->getDoctrine()->getManager();
            $formData = $form->getData();
            $user_exist = $this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findOneByEmail($formData->getEmail());
            $card_exist = $this->getDoctrine()->getRepository('UserInterfaceBundle:Cards')->findOneByNumber($formData->getCard()->getNumber());
            if($card_exist) {
                if($user_exist) {
                    $message = 'Vous êtes déjà incrit, <a href="#">connectez-vous</a>.';
                    return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message
                    ));
                } else if($this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findOneByCards($card_exist)) {
                    $message = 'Ce numéro de carte n\'est pas valide.';
                    return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message
                    ));
                } else if (preg_match('/^[a-zA-Z] [a-zA-Z]+$/i', $formData->getName())) {
                    $message = 'Le nom est invalide.';
                    return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message
                    ));
                } else if (!filter_var($formData->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $message = 'L\'email est invalide.';
                    return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message
                    ));
                } else if($formData->getPassword() !== $formData->getPasswordCheck()) {
                    $message = 'Les 2 mots passes ne sont pas identiques.';
                    return $this->render('UserInterfaceBundle:Signup:signup.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message
                    ));
                } else {
                    $salt = uniqid(mt_rand(), true);
                    $user->setSalt($salt);
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                    $user->setPassword($password);
                    $user->setCard($card_exist);
                    $user->getCard()->setValidUntill(new \DateTime());
                    if ($formData->getFile()) {
                        $user->upload($formData->getFile());
                    }
                    $user->setRoles("traveler");
                    $em->persist($user);
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('user_interface_homepage', array('name' => $user->getName())));
            } else {
                $message = 'Ce numéro de carte n\'est pas valide.';
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
