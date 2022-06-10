<?php

namespace App\Controller;

use App\Entity\Attache;
use App\Form\AttacheType;
use App\Repository\AttacheRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Routing\Annotation\Route;

class AttacheController extends AbstractController
{
    #[Route('/attache', name: 'app_attache')]
    public function index(
        Request $request,
        UserPasswordHasherInterface $hasPassword,
        EntityManagerInterface $manager
    ): Response
    {


        $attache=new Attache();
        $attache->setRoles(["ROLE_AC"]);
        $form=$this->createForm(AttacheType::class,$attache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mdpAtt=$attache->getPassword();
            $attache->setPassword($hasPassword->hashPassword($attache,$mdpAtt));
            $manager->persist($attache);
            $manager->flush();
            $this->redirectToRoute('app_attache');
        }
        return $this->render('attache/index.html.twig', [
            "title"=>"GESTION DES ATTACHES",
            "form"=>$form->createView()
        ]);
    }



    #[Route('/liste', name: 'liste_attache')]
    public function liste(AttacheRepository $attRepo):Response{
$attaches=$attRepo->findAll();
// dd($attaches);
        return $this->render('attache/liste.html.twig', [
           "title"=>"LISTE DES ATTACHES",
           "attaches"=>$attaches
        ]);
    }


    #[Route('/editer/{id}', name: 'app_editer')]
    
    public function editer(
        Attache $ac,EntityManagerInterface $manager,Request $request): Response
    {

       
        // $attache->setRoles(["ROLE_AC"]);
        $form=$this->createForm(AttacheType::class,$ac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $mdpAtt=$ac->getPassword();
            // $attache->setPassword($hasPassword->hashPassword($attache,$mdpAtt));
            $manager->persist($ac);
            $manager->flush();
            $this->redirectToRoute('app_attache');
        }


        return $this->render('attache/editer.html.twig', [
            "formEdit"=>$form->createView()
         ]);

    }
}
