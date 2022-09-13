<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testSubmitLoginForm(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('login');
        $form = $button->form();

        $client->submit($form, [
            'email' => 'johndoe@gmail.com',
            'password' => 'secret'
        ]);

        $this->assertResponseRedirects();
    }
}
