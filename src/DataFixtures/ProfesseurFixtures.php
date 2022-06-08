<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use App\Entity\Responsable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker=Factory::create();

        $rp=new Responsable();
        $rp->setNomComplet("Souleymane Diallo");
        $rp->setEmail("diallo@gmail.com");
        $rp->setPassword("passer");
        $manager->persist($rp);

     
        $classe=new Classe();
        $classe->setResponsable($rp);
        $classe->setNomClasse($faker->word(6,true));
        $manager->persist($classe);

        for ($i=1; $i <=10; $i++) { 
            $module=new Module;
            $module->setNomModule("Mathematique");
            $module->setLibelleModule("Module de 48h");
            $manager->persist($module);
            
         }

        $professeur=new Professeur();
        $professeur->setResponsable($rp);
        $professeur->setNomComplet("Mbaye sow");
        $professeur->setGrade("Expert");
        $professeur->addClass($classe);
        $professeur->addModule($module);
        $manager->persist($professeur);
    
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
