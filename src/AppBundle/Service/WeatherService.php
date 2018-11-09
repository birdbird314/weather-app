<?php

namespace AppBundle\Service;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use AppBundle\Service\WeatherProvider\Dummy\DummyWeatherProvider;

class WeatherService
{
    /** @var CitiesService */
    private $citiesService;

    public function __construct(CitiesService $citiesService) {
        $this->citiesService = $citiesService;
    }

    public function currentWeather($cityId): Weather 
    {
        $city = $this->citiesService->findById($cityId);
        return $this->current()->currentWeather($city);
    }

    private function current(): WeatherProvider
    {
        return new DummyWeatherProvider();
    }
}