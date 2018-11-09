<?php

namespace AppBundle\Service\WeatherProvider;

use AppBundle\Entity\City;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CurrentlyUsedWeatherProvider implements WeatherProvider
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function currentWeather(City $city): Weather
    {
        return $this->current()->currentWeather($city);
    }

    private function current(): WeatherProvider
    {
        return $this->container->get('provider.openWeatherMap');
    }
} 