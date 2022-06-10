<?php

namespace App\Controller;
// use App\Entity\Attache;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Repository\AnneeScolaireRepository;
use App\Repository\AttacheRepository;
use App\Repository\ClasseRepository;
use App\Repository\FiliereRepository;
use App\Repository\NiveauRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Instanceof_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(
        UserPasswordHasherInterface $passHah,
        AttacheRepository $attacheRepo,
        AnneeScolaireRepository $anneeRepo,
        ClasseRepository $classeRepo,
        NiveauRepository $niv,
        FiliereRepository $fili,
        Request $request, 
        EntityManagerInterface $menager): Response
    {
        $etudiant=new Etudiant();
        $etudiant->setRoles(["ROLE_ETUDIANT"]);
        $inscription=new Inscription();

        $classes=$classeRepo->findAll();
        $annees=$anneeRepo->findAll();
        $ac =$attacheRepo->findAll();
        // dd($ac);
        $niveau=$niv->findAll();
        $filieres=$fili->findAll();

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
        $attIns=$attacheRepo->find($request->get('att'));
        $mdp=$etudiant->getPassword();
        $etudiant->setPassword( $passHah->hashPassword($etudiant,$mdp));
        $classeIns=$classeRepo->find($request->get('classe'));
        $anneeIns=$anneeRepo->find($request->get('annee'));
        $filiIns=$fili->find($request->get('niveau'));
        $nivIns=$niv->find($request->get('filiere'));
        // envoiedes données
        $menager->persist($etudiant);
        $inscription->setEtudiant($etudiant);
        $inscription->setAttache($attIns);
        $inscription->setClasse($classeIns);
        $inscription->setNiveau($nivIns);
        $inscription->setFiliere($filiIns);
        $inscription->setAnneeScolaire($anneeIns);
        $menager->persist($inscription);

        $menager->flush();

    }     


        //    dd($_POST);
        return $this->render('inscription/index.html.twig', [
          "form"=>$form->createView(),
          "title"=>"GESTION DES ETUDIANTS",
           "ac"=>$ac,
           "annees"=>$annees,
           "classes"=>$classes,
           "filieres"=>$filieres,
           "niveau"=>$niveau
        ]);
    }
}
