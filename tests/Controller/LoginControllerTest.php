<?php

namespace App\Tests\Controller;

use App\Controller\LoginController;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginControllerTest extends WebTestCase
{
    public function testAccessLoginReturnStatusOK(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testRedirectWhenAuthenticated(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);

        $client->loginUser($user, 'main');
        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(302);
    }

}
