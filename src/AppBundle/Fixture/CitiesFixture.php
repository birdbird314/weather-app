<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CitiesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $london = new City();
        $london
            ->setCityName('London')
            ->setContryCode('UK');
        
        $chicago = new City();
        $chicago
            ->setCityName('Chicago')
            ->setContryCode('US');

        $warsaw = new City();
        $warsaw
            ->setCityName('Warsaw')
            ->setContryCode('PL');
        
        $budapest = new City();
        $budapest
            ->setCityName('Budapest')
            ->setContryCode('HU');
        
        $manager->persist($london);
        $manager->persist($chicago);
        $manager->persist($warsaw);
        $manager->persist($budapest);

        $manager->flush();
    }
}