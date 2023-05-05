<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
    public function edit(User $user, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher): Response
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
        // dd($hasher->isPasswordValid($user, $form->getData()->getPlainPassword()));
        if($form->isSubmitted() && $form->isValid())
        {
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword()))
            {
                $form->getData();
                $userRepository->save($user, true);
                return $this->redirectToRoute('app_home'); 
            }
            else
            {
                $this->addFlash('warning', "le mot de passe n'a pas été modifié");
            }
              
        }
        return $this->render('user/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit/password/{id}', name: 'edit_password')]
    public function editPassword(User $user, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) 
            {
                $user->setPassword(
                    $hasher->hashPassword($user,$form->getData()['newPassword'])
                );

                $userRepository->save($user,true);
                $this->addFlash('success','Le mot de passe a bien été modifié');
                return $this->redirectToRoute('app_login_connection');
            }
        }

        return $this->render('user/edit_password.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
