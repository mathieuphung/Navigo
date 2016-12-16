<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaymentController extends Controller
{
    public function PaymentAction()
    {
        return $this->render('UserInterfaceBundle:Payment:Payment.html.twig', array());
    }
    
    public function PaymentCheckAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $card = $user->getCard();
        $date = $card->getValidUntill();
        $cardExpired = $date < new \DateTime();
        if($cardExpired == true) {
            $date = new \DateTime();
        }
        
        switch ($_POST["time"]) {
            case "week":
                $date->add(new \DateInterval('P1W'));
                $card->setValidUntill(new \DateTime($date->format('Y-m-d')));
                $em->persist($card);
                $em->flush();
                break;
            case "month":
                $date->add(new \DateInterval('P1M'));
                $card->setValidUntill(new \DateTime($date->format('Y-m-d')));
                $em->persist($card);
                $em->flush();
                break;
            case "year":
                $date->add(new \DateInterval('P1Y'));
                $card->setValidUntill(new \DateTime($date->format('Y-m-d')));
                $em->persist($card);
                $em->flush();
                break;
        }
        
        return $this->render('UserInterfaceBundle:CardCheck:CardCheck.html.twig', array(
            'user' => $user,
            'expired' => false,
        ));
    }

}
