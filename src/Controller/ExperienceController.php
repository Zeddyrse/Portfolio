<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Repository\ExperienceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/experience', name: 'experience_')]
class ExperienceController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ExperienceRepository $experienceRepository): Response
    {

        $experiences = $experienceRepository->findAll();

        return $this->render('experience/index.html.twig', [
            'controller_name' => 'ExperienceController',
            'experiences' => $experiences,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request) : Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
        }
        return $this->render('experience/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
