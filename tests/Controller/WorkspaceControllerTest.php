<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkspaceControllerTest extends WebTestCase
{
    public function testSubmitWorkspaceForm(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);

        $client->loginUser($user);
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('add-workspace');
        $form = $button->form();

        $client->submit($form, [
            'workspace_form[name]' => 'Workspace',
            'workspace_form[description]' => 'Lorem ipsum...'
        ]);

        $this->assertResponseRedirects('/');
    }

    public function testSubmitWorkspaceFormWithoutDescription(): void
    {
        $client = static::createClient();
        $repository = $client->getContainer()->get(UserRepository::class);
        $user = $repository->find(1);

        $client->loginUser($user);
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('add-workspace');
        $form = $button->form();

        $client->submit($form, [
            'workspace_form[name]' => 'Workspace',
            'workspace_form[description]' => null
        ]);

        $this->assertResponseRedirects('/');
    }
}
