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
            'email' => 'testuser@example.com', // Testgebruiker (moet in testdatabase bestaan)
            'password' => 'testpassword'
        ]);

        $client->submit($form);
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('a[href="/logout"]'); // Check of de uitlogknop zichtbaar is
    }

    public function testRedirectAfterLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order/history');

        // Wordt doorgestuurd naar login
        $this->assertResponseRedirects('/login');

        // Log nu in
        $client->request('GET', '/login');
        $form = $crawler->selectButton('Inloggen')->form([
            'email' => 'testuser@example.com',
            'password' => 'testpassword'
        ]);
        $client->submit($form);
        $client->followRedirect();

        // Nu moet de gebruiker naar order history gestuurd worden
        $this->assertRouteSame('order_history');
    }

    public function testAccessDeniedForGuests(): void
    {
        $client = static::createClient();
        $client->request('GET', '/order/history');

        $this->assertResponseRedirects('/login');
    }

    public function testLogout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/logout');
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('a[href="/login"]'); // Check of de inlogknop weer zichtbaar is
    }

    public function testCSRFProtection(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Inloggen')->form([
            'email' => 'testuser@example.com',
            'password' => 'testpassword',
            '_csrf_token' => 'wrong-token' // Foute token
        ]);

        $client->submit($form);
        $this->assertResponseStatusCodeSame(403); // CSRF moet in fout eindigen
    }
}
