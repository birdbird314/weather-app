<?php

namespace AppBundle\Service;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use AppBundle\Service\WeatherProvider\WeatherSourcingFailedException;
use AppBundle\Service\WeatherCache\WeatherCache;

class WeatherService 
{
    /** @var CitiesService */
    private $citiesService;
    /** @var WeatherProvider */
    private $weatherProvider;
    /** @var WeatherCache */
    private $weatherCache;

    public function __construct(
        CitiesService $citiesService, 
        WeatherProvider $weatherProvider,
        WeatherCache $weatherCache
    ) {
        $this->citiesService = $citiesService;
        $this->weatherProvider = $weatherProvider;
        $this->weatherCache = $weatherCache;
    }

    public function currentWeather($cityId): Weather 
    {
        $city = $this->citiesService->findById($cityId);
        try {
            $weather = $this->weatherProvider->currentWeather($city);
            $this->weatherCache->cacheIfNeeded($cityId, $weather);
            return $weather;
        } catch (WeatherSourcingFailedException $e) {
            return $this->weatherCache->get($cityId);
        }
    }
}