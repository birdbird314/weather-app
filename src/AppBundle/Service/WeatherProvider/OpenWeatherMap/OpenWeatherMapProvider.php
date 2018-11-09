<?php

namespace AppBundle\Service\WeatherProvider\OpenWeatherMap;

use AppBundle\Entity\City;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use AppBundle\Service\WeatherProvider\OpenWeatherMap\OpenWeatherMapClient;

class OpenWeatherMapProvider implements WeatherProvider
{
    /** @var OpenWeatherMapClient */
    private $client;

    public function __construct(OpenWeatherMapClient $client) {
        $this->client = $client;
    } 

    public function currentWeather(City $city): Weather
    {
        $weather = $this->client->getResponse($city->getCityName(), $city->getContryCode());        
        return (new Weather())
            ->setTemperature($weather->main->temp)
            ->setHumidity($weather->main->humidity) 
            ->setPressure($weather->main->pressure)
            ->setWindSpeed($weather->wind->speed);
    }
}