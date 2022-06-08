<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use App\Entity\Attache;
use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Inscription;
use App\Entity\Niveau;
use App\Entity\Responsable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $rp=new Responsable();
        $rp->setNomComplet("Souleymane Diallo");
        $rp->setEmail("sow@gmail.com");
        $rp->setPassword("passer");
        $manager->persist($rp);
        $faker=Factory::create();
        // $ac=new Attachee();
        $ac=new Attache();
        $ac->setNomComplet("Souleymane Diallo");
        $ac->setEmail("diallo23@gmail.com");
        $ac->setPassword("passer");
        $manager->persist($ac); 

        for ($i=0; $i<=20; $i++) { 
            $etudiant=new Etudiant();
            $etudiant->setNomComplet($faker->name());
            $etudiant->setEmail($faker->email());
            $etudiant->setPassword($faker->password());
            $etudiant->setMatricule($faker->name());
            $etudiant->setSexe("m");
            $etudiant->setAdresse($faker->name());
            $manager->persist($etudiant); 
            // $manager->flush();
        // }
            
            $annee=new AnneeScolaire();
        $annee->setLibelle("2021-2022");
        $annee->setAnnee("etat");
        $manager->persist($annee);
        
        $classe=new Classe(); 
        $classe->setNomClasse($faker->name());
        $classe->setResponsable($rp);
            $manager->persist($classe);

          $filiere=new Filiere();
          $filiere->setNomFiliere($faker->name());
          $manager->persist($filiere);

          $niveau=new Niveau();
          $niveau->setNomNiveau($faker->name());
          $manager->persist($niveau);


       $ins=new Inscription();
       $ins->setAnneeScolaire($annee);
       $ins->setAttache($ac);
       $ins->setEtudiant($etudiant);
       $ins->setClasse($classe);
       $ins->setFiliere($filiere);
       $ins->setNiveau($niveau);
       $manager->persist($ins); 

        }
        $manager->flush();
    
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
    }
}
