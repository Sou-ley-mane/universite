<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    
    public function index(EtudiantRepository $etudiantRepo): Response
    {
        $etudiants=$etudiantRepo->findAll();
        // dd($etudiants);
        return $this->render('etudiant/liste.html.twig', [
            // 'controller_name' => 'EtudiantController',
            "title"=>"LISTE DES ETUDIANTS",
            "etudiants"=>$etudiants
        ]);
    }

    #[Route('/etudiant/{id}', name: 'app_detail_etudiant')]
    
    public function detail(int $id,EtudiantRepository $etuRepo): Response
    {
      $detail=$etuRepo->find($id);

// dd($detail);
        return $this->render('etudiant/detail.html.twig', [
           "detail"=>$detail
        ]);

    }


  
}
