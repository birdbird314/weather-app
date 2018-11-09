<?php

namespace AppBundle\Service\WeatherProvider\OpenWeatherMap;

class OpenWeatherMapClient
{
    private $openWeatherKey;

    public function __construct($openWeatherKey) {
        $this->openWeatherKey = $openWeatherKey;
    }

    public function getResponse($cityName, $countryCode)
    {
        $session = curl_init($this->queryUrl($cityName, $countryCode));
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($session);
        return json_decode($response);
    }

    private function queryUrl($cityName, $countryCode)
    {
        $baseUrl = 'api.openweathermap.org/data/2.5/weather';
        return $baseUrl . '?q=' . $cityName . ',' . $countryCode . '&APPID=' . $this->openWeatherKey . '&units=metric';
    }
}