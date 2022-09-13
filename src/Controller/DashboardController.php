<?php

namespace App\Controller;

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

        return $this->render('views/dashboard.html.twig', [
            'user' => $user
        ]);
    }
}
