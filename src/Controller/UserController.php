<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user', name: 'app_user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(User $user, Request $request, UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login_connection');
        }

        if($this->getUser()->getId() !== $user->getId())
        {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_home');   
        }
        return $this->render('user/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
