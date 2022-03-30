<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DevisRepository;
use App\Repository\TaillerRepository;
use App\Repository\UtilisateurRepository;
use App\Entity\Utilisateur;
use App\Entity\Devis;
use App\Entity\Tailler;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class ShowDevisController extends AbstractController
{
    #[Route('/consultation/devis', name: 'devis_index')]
    public function index(DevisRepository $devis, TaillerRepository $tailler, UtilisateurRepository $user,ManagerRegistry $doctrine): Response
    {
        $request = Request::createFromGlobals();
        if($request->query->get('id')){
            $entityManager = $doctrine->getManager();
            
            $deleteDevis = $this->getDoctrine()->getRepository(Devis::class)->find($request->query->get('id'));
            $deleteTailler = $this->getDoctrine()->getRepository(Tailler::class)->findBy(['devis'=>$deleteDevis]);

            foreach ($deleteTailler as $leTailler){
                $entityManager->remove($leTailler);
            }
            $entityManager->flush();
            $entityManager->remove($deleteDevis);
            $entityManager->flush();
        }

        $liste = [];
        $lesDevis = $devis->findAll();
        
        foreach ($lesDevis as $unDevis) {
            $lesTailler = $tailler->findBy(['devis' => $unDevis]);
            $user = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find($unDevis->getUtilisateur()->getId());
            
            $leDevis = (object) ['devis'=>$unDevis, 'user'=>$user, 'tailler'=>$lesTailler];
            $liste[] = $leDevis;
        }

        
        

        return $this->render('consultationDevis/index.html.twig', [
            'controller_name' => 'ShowDevisController',
            'liste' => $liste
        ]);
    }
}
