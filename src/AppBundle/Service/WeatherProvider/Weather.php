<?php

namespace AppBundle\Service\WeatherProvider;

class Weather 
{
    private $temperature;
    private $humidity;
    private $pressure;
    private $windSpeed;

    public function setTemperature($temperature): Weather
    {
        $this->temperature = $temperature;
        return $this;
    }

    public function setHumidity($humidity): Weather
    {
        $this->humidity = $humidity;
        return $this;
    }

    public function setPressure($pressure): Weather
    {
        $this->pressure = $pressure;
        return $this;
    }

    public function setWindSpeed($windSpeed): Weather
    {
        $this->windSpeed = $windSpeed;
        return $this;
    }

    public function asArray()
    {
        return [
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'pressure' => $this->pressure,
            'windSpeed' => $this->windSpeed,
        ];
    }
}