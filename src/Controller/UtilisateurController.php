<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateur')]
class UtilisateurController extends AbstractController
{
    #[Route('/', name: 'utilisateur_index', methods: ['GET', 'POST'])]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        $erreur = false;
        $request = Request::createFromGlobals();

        if($request->query->get('erreur') == 1){
            $erreur = true;
        }

        if ($request->isMethod('POST')){
            if($request->get('nom'))

            return $this->render('utilisateur/index.html.twig', [
                'utilisateurs' => $utilisateurRepository->findBy(['nom'=>$request->get('nom')]),
                'erreur'=>$erreur
            ]);
        }

        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
            'erreur'=>$erreur
        ]);
    }

    #[Route('/new', name: 'utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'utilisateur_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('registration/register.html.twig', [
            'utilisateur' => $utilisateur,
            'registrationForm' => $form,
            'action' => 'Mettre à jour',
            'tiltle' => 'Formulaire de modification',
            'isUpdate' => true
        ]);
    }

    #[Route('/{id}', name: 'utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager,UtilisateurRepository $utilisateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            
            try{
                $entityManager->remove($utilisateur);
                $entityManager->flush();
                return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
            } catch(\Throwable $th){
                return $this->redirectToRoute('utilisateur_index', ['erreur'=>1], Response::HTTP_SEE_OTHER);
            }
            
        }

        
    }
}
