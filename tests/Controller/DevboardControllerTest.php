<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DevboardControllerTest extends WebTestCase
{

    public function testAccessDevboardGrantedWhenAuthenticated(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);

        $client->loginUser($user, 'main');
        $client->request('GET', '/devboard');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testRedirectWhenNotAuthenticated(): void
    {
        $client = static::createClient();
        $client->request('GET', '/devboard');

        $this->assertResponseStatusCodeSame(302);
    }
}
