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
            'registration_form[email]' => 'newuser@example.com',
            'registration_form[plainPassword][first]' => 'testpassword',
            'registration_form[plainPassword][second]' => 'testpassword'
        ]);

        $client->submit($form);
        $client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'Registratie gelukt');
    }

    public function testUserLoginAndRedirect(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Inloggen')->form([
            'email' => 'testuser@example.com',
            'password' => 'testpassword'
        ]);

        $client->submit($form);
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('a[href="/logout"]');
    }

    public function testLogoutWorks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('a[href="/login"]');
    }

    public function testOrderProcess(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pizza/1'); // Ga naar een pizza-pagina

        $form = $crawler->selectButton('Toevoegen aan winkelwagen')->form();
        $client->submit($form);
        $client->followRedirect();

        $this->assertSelectorExists('a[href="/order/cart"]'); // Check of winkelwagen werkt

        $client->request('GET', '/order/checkout');
        $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Bedankt voor je bestelling');
    }

    public function testAccessDeniedForGuests(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/history');

        $this->assertResponseRedirects('/login');
    }

    public function testPizzaCRUD(): void
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@example.com',
            'PHP_AUTH_PW'   => 'adminpassword',
        ]);

        // Test pizza toevoegen
        $crawler = $client->request('GET', '/admin/pizza/new');
        $form = $crawler->selectButton('Opslaan')->form([
            'pizza[name]' => 'Test Pizza',
            'pizza[description]' => 'Een heerlijke testpizza',
            'pizza[price]' => 12.99
        ]);
        $client->submit($form);
        $client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'Pizza is toegevoegd');

        // Test pizza verwijderen
        $crawler = $client->request('GET', '/admin/pizza');
        $deleteButton = $crawler->selectButton('Verwijderen')->form();
        $client->submit($deleteButton);
        $client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'Pizza is verwijderd');
    }
}
