<?php

namespace App\Controller;

use App\Form\WorkspaceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevboardController extends AbstractController
{
    #[Route('/devboard', name: 'app_devboard')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();

        $workspace_form = $this->createForm(WorkspaceFormType::class);

        return $this->renderForm('auth/devboard.html.twig', [
            'user' => $user,
            'workspace_form' => $workspace_form
        ]);
    }
}
