<?php

namespace AppBundle\Service;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use AppBundle\Service\WeatherProvider\WeatherSourcingFailedException;

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
        try {
            return $this->weatherProvider->currentWeather($city);
        } catch (WeatherSourcingFailedException $e) {
            return (new Weather());
        }
    }
}