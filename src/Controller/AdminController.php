<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_GESTIONNAIRE')]
class AdminController extends AbstractController
{
    // "/admin" = le lien « Espace admin » du menu de la page d'accueil.
    // Page d'arrivée après la connexion : le planning (maquette Gestion – Planning) viendra ici.
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
