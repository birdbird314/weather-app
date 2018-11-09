<?php

namespace AppBundle\Service;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;

class WeatherService 
{
    /** @var CitiesService */
    private $citiesService;
    /** @var WeatherProvider */
    private $weatherProvider;

    public function __construct(CitiesService $citiesService, WeatherProvider $weatherProvider) {
        $this->citiesService = $citiesService;
        $this->weatherProvider = $weatherProvider;
    }

    public function currentWeather($cityId): Weather 
    {
        $city = $this->citiesService->findById($cityId);
        return $this->weatherProvider->currentWeather($city);
    }
}