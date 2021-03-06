<?php

namespace AppBundle\Repository;

use AppBundle\Entity\City;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;


/**
 * CityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CityRepository extends \Doctrine\ORM\EntityRepository
{
    public function __construct(EntityManagerInterface $em) 
    {
        parent::__construct($em, new ClassMetadata(City::class));
    }

    public function add(City $city)
    {
        $this->_em->persist($city);
        $this->_em->flush();
    }

    public function remove(City $city)
    {
        $this->_em->remove($city);
        $this->_em->flush();
    }
}
