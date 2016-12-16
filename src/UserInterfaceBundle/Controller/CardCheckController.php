<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CardCheckController extends Controller
{
    public function CardCheckAction()
    {
        $user = $this->getUser();
        $date = $user->getCard()->getValidUntill();
        $cardExpired = $date < new \DateTime();
    
        return $this->render('UserInterfaceBundle:CardCheck:CardCheck.html.twig', array(
            'user' => $user,
            'expired' => $cardExpired,
        ));
    }

}
