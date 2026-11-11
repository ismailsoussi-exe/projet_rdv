<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $langues = [
            ['code' => 'EN', 'nom' => 'Anglais',  'accroche' => 'Speak with confidence', 'classe' => 'en'],
            ['code' => 'DE', 'nom' => 'Allemand', 'accroche' => 'Sprechen Sie frei',      'classe' => 'de'],
            ['code' => 'ES', 'nom' => 'Espagnol', 'accroche' => 'Habla con soltura',      'classe' => 'es'],
        ];

        return $this->render('home/index.html.twig', [
            'langues' => $langues,
            'semestre' => 'Second semestre',
        ]);
    }
}
