<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/login', name:'app_login_')]
class SecurityController extends AbstractController
{
    #[Route('/connection', name: 'connection')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' =>  $authenticationUtils->getLastUsername()
        ]);
    }

    #[Route('/deconnection', name: 'deconnection')]
    public function logout()
    {

    }

    #[Route('/registration', name: 'registration')]
    public function registration(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $user->setRoles(["ROLE_USER"]);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();
            $userRepository->save($user, true);
            $this->addFlash('success', 'Votre compte a bien été crée');
            return $this->redirectToRoute('app_login_connection');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
