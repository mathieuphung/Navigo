<?php

namespace UserInterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BillController extends Controller
{
    public function BillsAction() {
        $user = $this->getUser();
        $bills = $this->getDoctrine()->getRepository('UserInterfaceBundle:Bills')->findByUsers($user);
        
        return $this->render('UserInterfaceBundle:Bill:Bills.html.twig', array(
            'bills' => $bills,
        ));
    }
    public function GenerateAction($bill)
    {
        $bill = $this->getDoctrine()->getRepository('UserInterfaceBundle:Bills')->findOneById($bill);
        $html = $this->renderView('UserInterfaceBundle:Bill:Generate.html.twig', array(
            
        ));
    
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }

}
