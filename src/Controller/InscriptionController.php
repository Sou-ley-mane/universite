<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Repository\AnneeScolaireRepository;
use App\Repository\AttacheRepository;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Instanceof_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(
        Request $request,
        AttacheRepository $attacheRepo,
        AnneeScolaireRepository $anneeRepo,
        ClasseRepository $classeRepo,
        EntityManagerInterface $menager): Response
    {
        $etudiant=new Etudiant();
        $inscription=new Inscription();

        $classes=$classeRepo->findAll();
        $annees=$anneeRepo->findAll();
        $ac =$attacheRepo->findAll();

// Creation du formulaire
$form=$this->createFormBuilder($etudiant)
           ->add('nomComplet')
           ->add('adresse')
           ->add('email')
           ->add('password')
           ->add('sexe')
           ->add('matricule')
           ->getForm();
       
    $form->handleRequest($request); //    POur traiter les données du formulaire
    if ($form->isSubmitted() && $form->isValid()) {
      
    }     


           



           


        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }
}
