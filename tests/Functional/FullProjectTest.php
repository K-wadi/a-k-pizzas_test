<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FullProjectTest extends WebTestCase
{
    public function testHomePageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'A&K Pizza\'s');
    }

    public function testUserRegistration(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Registreren')->form([
            'registration_form[email]' => 'newuser@pizza.com',
            'registration_form[plainPassword][first]' => 'password123',
            'registration_form[plainPassword][second]' => 'password123'
        ]);

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('/login', $client->getResponse()->headers->get('Location'));
    }

    public function testUserLoginAndRedirect(): void
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

    public function testOrderProcess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/cart');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1, h2');
    }

    public function testPizzaCRUD(): void
    {
        $client = static::createClient();
        $client->request('GET', '/pizza/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1, h2');
    }

    public function testAccessDeniedForGuests(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertStringContainsString('/login', $client->getResponse()->headers->get('Location'));
    }
}
