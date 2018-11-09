<?php

namespace AppBundle\Service\WeatherProvider;

use AppBundle\Entity\City;
use AppBundle\Service\WeatherProvider\Weather;

interface WeatherProvider
{
    public function currentWeather(City $city): Weather; 
}