<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $exercicesName = [
            'Leg curl',
            'Leg extension',
            'Rotary Calf',
            'Adducteur',
            'Abducteur',
            'Leg press',
            'Lower back',
            'Upperback',
            'Poulie basse', 
            'Poulie haute',
            'Pulldown',
            'Dips',
            'Crunch abdo',
            'Delts machine',
            'Traction assiste',
            'Pectoral',
            'Dev. couché',
            'Dev. couché incliné',
            'Arm extension',
            'Curl biceps'
        ];

        foreach ($exercicesName as $name) {
            $exercice = new Exercice();
            $exercice->setName($name);
            $manager->persist($exercice);
        }

        $manager->flush();
    }
}
