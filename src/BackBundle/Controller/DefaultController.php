<?php

namespace BackBundle\Controller;

use BackBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $searchForm = $this->createForm(new SearchType(), null, array("action" => $this->generateUrl('back_homepage'), "method" => "POST"));
        if ($searchForm->handleRequest($request)->isValid())
        {
            $formData = $searchForm->getData();
            $card_exists = $this->getDoctrine()->getRepository('UserInterfaceBundle:Cards')->findByNumber($formData["searchField"]);
            if(empty($card_exists)) {
                if (!filter_var($formData["searchField"], FILTER_VALIDATE_EMAIL)) {
                    $results = $this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findByName($formData["searchField"]);
                } else {
                    $results = $this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findByEmail($formData["searchField"]);
                }
                
            } else {
                $results = $this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findByCards($card_exists);
            }
            return $this->render('BackBundle:Default:index.html.twig', array(
                "searchForm" => $searchForm->createView(),
                "results" => $results
            ));
        }
        return $this->render('BackBundle:Default:index.html.twig', array(
            "searchForm" => $searchForm->createView(),
        ));
    }
    
    public function addTimeAction($userId)
    {
        $searchForm = $this->createForm(new SearchType(), null, array("action" => $this->generateUrl('back_homepage'), "method" => "POST"));
        if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}+$/i', $_POST["time"])) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()->getRepository('UserInterfaceBundle:Users')->findOneById($userId);
            $card = $user->getCard();
            
            try {
                $date = new \DateTime($_POST["time"]);
            } catch (\Exception $e) {
                $message = "La date est invalide.";
                return $this->render('BackBundle:Default:index.html.twig', array(
                    "searchForm" => $searchForm->createView(),
                    "message" => $message,
                ));
            }
            $card->setValidUntill($date);
    
            $em->persist($card);
            $em->flush();
        } else {
            $message = "La date est invalide.";
            return $this->render('BackBundle:Default:index.html.twig', array(
                "searchForm" => $searchForm->createView(),
                "message" => $message,
            ));
        }
        
        return $this->render('BackBundle:Default:index.html.twig', array(
            "searchForm" => $searchForm->createView(),
        ));
    }
}
