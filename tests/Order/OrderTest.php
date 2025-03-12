<?php

namespace App\Tests\Order;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderTest extends WebTestCase
{
    public function testCartPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/cart');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Winkelwagen');
    }

    public function testAddToCart(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/add/1');

        $response = $client->getResponse();
        $this->assertTrue($response->isRedirect());
        $this->assertStringContainsString('/order/cart', $response->headers->get('Location'));
    }

    public function testCheckoutRedirectsToLoginWhenNotAuthenticated(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/checkout');
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('/login', $client->getResponse()->getTargetUrl());
    }
}
