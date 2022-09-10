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
    #[Route('/devboard/add', name: 'app_workspace_add')]
    public function newWorkspace(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();
        $form = $this->createForm(WorkspaceFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $workspace = new Workspace();
            $workspace->setName($data['name']);
            $workspace->setDescription($data['description']);

            $manager = $managerRegistry->getManager();
            $manager->persist($workspace);
            $manager->flush();

            return $this->redirectToRoute('app_devboard');
        }

        return $this->render('auth/devboard.html.twig', [
            'user' => $user,
        ]);

    }
}
