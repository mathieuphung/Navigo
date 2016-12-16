<?php

namespace UserInterfaceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardCheckControllerTest extends WebTestCase
{
    public function testCardcheck()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/verification-carte');
    }

}
