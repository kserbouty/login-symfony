<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{

    public function testAccessDashboardGranted(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);

        $client->loginUser($user, 'main');
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testAccessDashboardDenied(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseRedirects('/login');
    }
}
