<?php

namespace AppBundle\Service;

use AppBundle\Repository\CityRepository;

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
}