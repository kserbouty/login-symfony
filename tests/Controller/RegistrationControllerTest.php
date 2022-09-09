<?php

namespace App\Tests\Controller;

use App\Controller\RegistrationController;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testAccessRegistrationReturnStatusOK(): void
    {
        $client = static::createClient();
        $client->request('GET', '/register');

        $this->assertResponseStatusCodeSame(200);
    }

}
