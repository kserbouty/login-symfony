<?php

namespace App\Controller;

use App\Form\WorkspaceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        $workspace_form = $this->createForm(WorkspaceFormType::class);

        return $this->renderForm('views/dashboard.html.twig', [
            'user' => $user,
            'workspace_form' => $workspace_form
        ]);
    }
}
