<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserInterfaceBundle\Entity\Cards;
use UserInterfaceBundle\Form\CardsType;
use Symfony\Component\HttpFoundation\Request;

class CardCheckController extends Controller
{
    
    public function Check($card)
    {
        $date = $card->getValidUntill();
        return $date < new \DateTime();
    }
    
    public function CardCheckAction(Request $request)
    {
        $user = $this->getUser();
        if ($user != null) {
            $card = $user->getCard();
            $cardExpired = $this->Check($card);
        
            return $this->render('UserInterfaceBundle:CardCheck:CardCheck.html.twig', array(
                'card' => $card,
                'expired' => $cardExpired,
            ));
        } else {
            $cards = new Cards();
            $form = $this->createForm(new CardsType(), $cards, array("action" => $this->generateUrl('card_check')));
            if ($form->handleRequest($request)->isValid()) {
                $formData = $form->getData();
                $card_exist = $this->getDoctrine()->getRepository('UserInterfaceBundle:Cards')->findOneByNumber($formData->getNumber());
                if ($card_exist) {
                    $cardExpired = $this->Check($card_exist);
    
                    return $this->render('UserInterfaceBundle:CardCheck:CardCheck.html.twig', array(
                        'card' => $card_exist,
                        'expired' => $cardExpired,
                    ));
                } else {
                    $message = 'Ce numéro de carte n\'est pas valide.';
                    return $this->render('UserInterfaceBundle:CardCheck:AnonCardCheck.html.twig', array(
                        'form' => $form->createView(),
                        'message' => $message
                    ));
                }
            }
            return $this->render('UserInterfaceBundle:CardCheck:AnonCardCheck.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }
}
