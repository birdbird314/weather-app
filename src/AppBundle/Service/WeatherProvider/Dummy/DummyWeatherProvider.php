<?php

namespace AppBundle\Service\WeatherProvider\Dummy;

use AppBundle\Entity\City;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;


class DummyWeatherProvider implements WeatherProvider
{
    public function currentWeather(City $city): Weather
    {
        return (new Weather())
            ->setTemperature(25)
            ->setHumidity(70)
            ->setPressure(10200)
            ->setWindSpeed(10);
    } 
}