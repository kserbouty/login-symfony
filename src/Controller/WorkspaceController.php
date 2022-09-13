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
    #[Route('/', name: 'dashboard')]
    public function create(ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $workspaceForm = $this->createForm(WorkspaceFormType::class);
        $workspaces = $doctrine->getRepository(Workspace::class)->findAll();

        return $this->render('views/dashboard.html.twig', [
            'workspaceForm' => $workspaceForm->createView(),
            'workspaces' => $workspaces
        ]);
    }

    #[Route('/workspace/add', name: 'workspace_add')]
    public function store(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(WorkspaceFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $manager = $doctrine->getManager();

            $workspace = new Workspace();
            $workspace->setName($data['name']);
            $workspace->setDescription($data['description']);

            $manager->persist($workspace);
            $manager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->redirectToRoute('dashboard');
    }
}
