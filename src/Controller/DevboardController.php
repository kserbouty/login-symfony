<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevboardController extends AbstractController
{
    #[Route('/devboard', name: 'app_devboard')]
    public function index(): Response
    {
        return $this->render('auth/devboard.html.twig', [
            'controller_name' => 'DevboardController',
        ]);
    }
}
