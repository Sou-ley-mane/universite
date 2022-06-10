<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use App\Repository\EtudiantRepository;
use App\Repository\ResponsableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(
        Request $request,
        ResponsableRepository $rpRepo,
        EtudiantRepository $etudiantRepo,
        EntityManagerInterface $manager
    ): Response
    {
        $demande=new Demande();
        $formulaire=$this->createFormBuilder($demande)
        ->add('motif')
        ->add('message')
        ->add('date')
        ->getForm();
        $formulaire->handleRequest($request);
        $etudiants=$etudiantRepo->findAll();
        $rpVilideDemande=$rpRepo->findAll();
        // dd($rpVilideDemande);
if ($formulaire->isSubmitted()) {
    $etudiantDemande=$etudiantRepo->find($request->get('etudiant'));
    $rpDemande=$rpRepo->find($request->get('respon'));

    $demande->setEtudiant($etudiantDemande);
    $demande->setResponsable($rpDemande);
    $manager->persist($demande);
    $manager->flush();
   
}
        return $this->render('demande/ajoutDemande.html.twig', [
            // 'controller_name' => 'DemandeController',
            "form"=>$formulaire->createView(),
            "title"=>"GESTION DES DEMANDES",
            "rp"=>$rpVilideDemande,
            "etudiants"=>$etudiants
        ]);
    }

    #[Route('/listeDemande', name: 'liste_demande')]
    public function listeDemande(DemandeRepository $demandeRepo):Response{
        $demandes=$demandeRepo->findAll();
        return $this->render('demande/liste.html.twig', [
            "demandes"=>$demandes,
            "title"=>"LISTE DES DEMANDES"
        ]);
    }
}
