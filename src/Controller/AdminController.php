<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/user', name: 'app_listeUser')]
    public function listeUser(UserRepository $userRepo): Response
    {

        $users=$userRepo->findAll();
    //    dd($users);
    //    die;
        return $this->render('admin/index.html.twig', [
            // 'controller_name' => 'AdminController',
         "users"=>$users
        ]);

    }
}
