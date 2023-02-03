<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjetType;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/projet', name: 'projet_')]
class ProjetController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjetController',
            'projects' => $projects
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProjectRepository $projectRepository): Response
    {
        $projet = new Project();

        $form = $this->CreateForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $projectRepository->save($projet, true);
            $this->addFlash('success', 'Projet sucessfully created !');
            return $this->redirectToRoute('projet_index');
        }
        return $this->render('project/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Project $project, Request $request, ProjectRepository $projectRepository): Response
    {

        $form = $this->CreateForm(ProjetType::class, $project);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $projectRepository->save($project, true);
            $this->addFlash('success', 'Projet sucessfully modify !');
            return $this->redirectToRoute('projet_index');
        }
        return $this->render('project/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Project $project, ProjectRepository $projectRepository): Response
    {
            $projectRepository->remove($project, true);
            $this->addFlash('success', 'Projet sucessfully delete !');
            return $this->redirectToRoute('projet_index');
    }
}


