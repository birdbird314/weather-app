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
        
        $manager->persist($london);
        $manager->persist($chicago);

        $manager->flush();
    }
}