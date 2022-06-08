<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // for ($i=1; $i <=10; $i++) { 
        //     $module=new Module();
        //     $module->setNomModule("Mathematique".$i);
        //     $module->setLibelleModule("Module de 48h");
        //     $manager->persist($module);
        // }
        // $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
    }
}
