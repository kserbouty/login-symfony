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

        $this->assertResponseIsSuccessful();
    }

    public function testRedirectToLoginWhenAccessDenied(): void
    {
        $client = static::createClient();
        $client->request('GET', '/devboard');

        $this->assertResponseRedirects('/login');
    }

    public function testAddWorkspaceIsSuccessful(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);
        $client->loginUser($user);
        $crawler = $client->request('GET', '/devboard');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('add-workspace');
        $form = $button->form();
        $form["workspace_form[name]"] = "Workspace";
        $form["workspace_form[description]"] = "Lorem ipsum...";

        $client->submit($form);
        $this->assertResponseRedirects('/devboard');
    }

    public function testAddWorkspaceWithoutDescriptionIsSuccessful(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);
        $client->loginUser($user);
        $crawler = $client->request('GET', '/devboard');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('add-workspace');
        $form = $button->form();
        $form["workspace_form[name]"] = "Workspace";
        $form["workspace_form[description]"] = null;

        $client->submit($form);
        $this->assertResponseRedirects('/devboard');
    }
}
