<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}
