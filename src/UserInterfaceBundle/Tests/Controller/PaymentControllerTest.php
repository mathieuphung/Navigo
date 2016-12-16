<?php

namespace UserInterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaymentControllerTest extends WebTestCase
{
    public function testPayment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'renouvellement-abonnement');
    }

}
