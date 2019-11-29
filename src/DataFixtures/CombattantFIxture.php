<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Nain;
use App\Entity\Troll;
use App\Entity\Elfe;


class CombattantFIxture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $nameElfes =  array("elfe-féquoi", "elfe-facies", "elfe-padré", "elfe-facteur", "elf-fachiste", "elfe-factice", "elfe-farmacien");
        $nameTroll = array("Ilin", "Zudah", "Edogel", "Edogel", "Xade", "Loh'maesok");
        $nameNain = array("nain-djardin", "nain-portequoi", "nain-posteur", "nain-jure", "nain-génu", "nain-timité", "bon-nain");

       for($i = 0; $i<10; $i++){

           $elfe = new Elfe();
           $elfe->setNom($nameElfes[array_rand($nameElfes)]);
           $manager->persist($elfe);

           $nain = new Nain();
           $nain->setNom($nameNain[array_rand($nameNain)]);
           $manager->persist($nain);

           $troll= new Troll();
           $troll->setNom($nameTroll[array_rand($nameTroll)]);
           $manager->persist($troll);

           $manager->flush();
       }

        $manager->flush();
    }
}
