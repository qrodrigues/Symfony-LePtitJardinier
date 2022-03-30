<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoixController extends AbstractController
{
    #[Route('/choix', name: 'choix')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('choix/index.html.twig', [
            'controller_name' => 'ChoixController',
            'user' => $user
        ]);
    }
}
