<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Haie;
use App\Entity\Devis;
use App\Entity\Tailler;
use DateTime;

class DevisController extends AbstractController
{
    #[Route('/devis', name: 'devis')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        $session = new Session();
        $selection = $session->get('mesures');

        $montantAvantRemise = 0;
        $montantApresRemise = 0;
        $selectionHaies = [];
        $remise = 0;
        $montantRemise = 0;

        foreach ($selection as $mesure) {
            $prixMultiplie = $mesure->prix * $mesure->longueur;
            if($mesure->hauteur > 1.5){
                $prixMultiplie *= 1.5;
            }
            $montantAvantRemise += $prixMultiplie;
            $uneMesure = (object) ['haie' => $mesure->typehaie, 'hauteur' => $mesure->hauteur, 'longueur' => $mesure->longueur, 'prixunitaire'=>$mesure->prix, 'prixmultiplie'=>$prixMultiplie];
            $selectionHaies[] = $uneMesure;
        }

        if($user->getTypeClient() == "entreprise"){
            $remise = 0.10;
        }

        $montantRemise = $montantAvantRemise * $remise;
        $montantApresRemise = $montantAvantRemise - $montantRemise;

        $request = Request::createFromGlobals();

        if ($request->isMethod('POST')){
            $entityManager = $doctrine->getManager();

            date_default_timezone_set('Europe/Paris');
            $devis = new Devis();
            $devis->setDate(new DateTime());
            $devis->setUtilisateur($user);
            $devis->setMontant($montantApresRemise);

            $entityManager->persist($devis);
            $entityManager->flush();

            foreach ($selection as $uneTaille) {
                $tailler = new Tailler();
                $haie = $doctrine->getRepository(Haie::class)->find($uneTaille->codehaie);

                $tailler->setCodeHaie($haie);
                $tailler->setHauteur($uneTaille->hauteur);
                $tailler->setLongueur($uneTaille->longueur);
                $tailler->setDevis($devis);

                $entityManager->persist($tailler);
                $entityManager->flush();
            }

            return $this->redirectToRoute('accueil', array('devis' => 1));
        }

        return $this->render('devis/index.html.twig', array(
        'typeuser' => $user->getTypeClient(),
        'remise' => $remise,
        'montantRemise' => $montantRemise,
        'montantApresRemise'=>$montantApresRemise,
        'montantAvantRemise'=>$montantAvantRemise,
        'selectionHaies'=>$selectionHaies
    ));
    }
}
