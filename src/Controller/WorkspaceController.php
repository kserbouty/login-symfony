<?php

namespace App\Controller;

use App\Entity\Workspace;
use App\Form\WorkspaceFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkspaceController extends AbstractController
{
    #[Route('/workspace-add', name: 'workspace_add')]
    public function newWorkspace(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        $form = $this->createForm(WorkspaceFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager = $managerRegistry->getManager();
            $workspace = new Workspace();

            $workspace->setName($data['name']);
            $workspace->setDescription($data['description']);

            $manager->persist($workspace);
            $manager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('views/dashboard.html.twig', [
            'user' => $user,
        ]);

    }
}
