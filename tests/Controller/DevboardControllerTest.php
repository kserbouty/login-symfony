<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DevboardControllerTest extends WebTestCase
{

    public function testRouteDevboardWithStatusOK(): void
    {
        $client = static::createClient();

        $userRepository = $client->getContainer()->get(UserRepository::class);

        $user = $userRepository->find(1);

        $client->loginUser($user, 'main');

        $client->request('GET', '/devboard');

        $this->assertResponseStatusCodeSame(200);
    }
}
