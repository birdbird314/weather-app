<?php

namespace AppBundle\Service;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use AppBundle\Service\WeatherProvider\Dummy\DummyWeatherProvider;
use AppBundle\Service\WeatherProvider\OpenWeatherMap\OpenWeatherMapProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WeatherService 
{
    /** @var CitiesService */
    private $citiesService;
    /** @var ContainerInterface */
    private $container;

    public function __construct(CitiesService $citiesService, ContainerInterface $container) {
        $this->citiesService = $citiesService;
        $this->container = $container;
    }

    public function currentWeather($cityId): Weather 
    {
        $city = $this->citiesService->findById($cityId);
        return $this->current()->currentWeather($city);
    }

    private function current(): WeatherProvider
    {
        return $this->container->get('provider.openWeatherMap');
    }
}