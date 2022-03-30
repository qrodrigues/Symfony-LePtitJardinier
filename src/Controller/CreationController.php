<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use App\Form\HaieType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreationController extends AbstractController
{
    #[Route('/creation', name: 'creation')]
    public function index(Request $request): Response
    {
        $haie = new Haie();

        $form = $this->createForm(HaieType::class, $haie);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($haie);
            $em->flush();
            
        }

        return $this->render(
            '/creation/index.html.twig',
            array('form' => $form->createView())
        );
    }
}
