<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Haie;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MesureController extends AbstractController
{
    #[Route('/mesure', name: 'mesure')]
    public function index(): Response
    {
        $haie = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->findAll();

        $session = new Session();
        $mesures = $session->get('mesures');
        // $session->remove('mesures');

        $request = Request::createFromGlobals();

        if ($request->isMethod('POST') && is_numeric($request->get('hauteur')) && is_numeric($request->get('longueur'))) {

            $typehaie = $request->get('typehaie');
            $lahaie = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->find($typehaie);

            $hauteur = $request->get('hauteur');
            $longueur = $request->get('longueur');
            $laMesure = (object) ['codehaie'=>$lahaie->getCode(),'typehaie' => $lahaie->getNom(), 'hauteur' => $hauteur, 'longueur' => $longueur,'prix' => $lahaie->getPrix()];
            $mesures[] = $laMesure;
            $session->set('mesures', $mesures);
        }

        if($request->query->get('id')){
            array_splice($mesures, $request->query->get('id') - 1, 1);
            $session->set('mesures', $mesures);   
        }

        return $this->render('mesure/index.html.twig', [
            'controller_name' => 'MesureController',
            'lesHaies' => $haie,
            'mesures' => $mesures
        ]);
    }
}
