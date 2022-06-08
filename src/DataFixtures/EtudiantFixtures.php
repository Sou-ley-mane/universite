<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker=Factory::create();
        // for ($i=0; $i<=20; $i++) { 
        //     $etudiant=new Etudiant();
        //     $etudiant->setNomComplet($faker->name());
        //     $etudiant->setEmail($faker->email());
        //     $etudiant->setPassword($faker->password());
        //     $etudiant->setMatricule($faker->name());
        //     $etudiant->setSexe("m");
        //     $etudiant->setAdresse($faker->name());
        //     $manager->persist($etudiant); 
        // }
        // $manager->flush();
       
       
       
       
       
       
        // $product = new Product();

        
        // $manager->persist($product);

        // $manager->flush();
    }
}
