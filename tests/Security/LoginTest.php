<?php

namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testLoginPageLoads(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Inloggen');
    }

    public function testUserCanLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Inloggen')->form([
            'email' => 'test@pizza.com',
            'password' => 'test123',
            '_csrf_token' => $crawler->filter('input[name="_csrf_token"]')->attr('value')
        ]);

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('/pizza/', $client->getResponse()->headers->get('Location'));
    }

    public function testRedirectAfterLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/history');

        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('/login', $client->getResponse()->headers->get('Location'));
    }
}
