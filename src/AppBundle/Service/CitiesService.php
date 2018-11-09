<?php

namespace AppBundle\Service;

use AppBundle\Repository\CityRepository;
use AppBundle\Entity\City;

class CitiesService
{
    /** @var CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepository) {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return City[]
     */
    public function allCities()
    {
        return $this->cityRepository->findAll();
    }

    /**
     * @return City
     */
    public function findById($id)
    {
        return $this->cityRepository->find($id);
    }

    public function add($cityName, $countryCode)
    {
        $city = (new City())
            ->setCityName($cityName)
            ->setContryCode($countryCode);
        $this->cityRepository->add($city);
    }
}