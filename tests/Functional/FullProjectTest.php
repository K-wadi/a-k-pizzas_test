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
        $this->assertResponseRedirects('/login');
    }
}
