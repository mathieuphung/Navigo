<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserInterfaceBundle\Entity\Bills;

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
        $price = 0.00;
        $cardExpired = $date < new \DateTime();
        if($cardExpired == true) {
            $date = new \DateTime();
        }
        
        switch ($_POST["time"]) {
            case "week":
                $date->add(new \DateInterval('P1W'));
                $price = 22.15;
                $card->setValidUntill(new \DateTime($date->format('Y-m-d')));
                break;
            case "month":
                $date->add(new \DateInterval('P1M'));
                $price = 73.00;
                $card->setValidUntill(new \DateTime($date->format('Y-m-d')));
                break;
            case "year":
                $date->add(new \DateInterval('P1Y'));
                $price = 803.00;
                $card->setValidUntill(new \DateTime($date->format('Y-m-d')));
                break;
        }
        
        $bill = new Bills();
        $bill->setUsers($user);
        $bill->setTotal($price);
        
        $em->persist($card);
        $em->persist($bill);
        $em->flush();
        
        return $this->render('UserInterfaceBundle:CardCheck:CardCheck.html.twig', array(
            'user' => $user,
            'expired' => false,
        ));
    }

}
