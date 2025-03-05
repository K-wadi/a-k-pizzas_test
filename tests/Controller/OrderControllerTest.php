<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    public function testCartPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/cart');

        $this->assertResponseIsSuccessful();
    }
}
