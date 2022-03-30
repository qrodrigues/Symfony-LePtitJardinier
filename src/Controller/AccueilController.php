<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function index(): Response
    {
        $confirmDevis = false;

        $request = Request::createFromGlobals();
        if($request->query->get('devis') == 1){
            $confirmDevis = true;
        }

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'confirmDevis' => $confirmDevis
        ]);
    }
}
