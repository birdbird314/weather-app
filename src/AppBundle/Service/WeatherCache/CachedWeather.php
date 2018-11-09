<?php

namespace AppBundle\Service\WeatherCache;

use AppBundle\Service\WeatherProvider\Weather;

class CachedWeather
{
    /** @var Weather */
    private $weather;
    /** @var DateTimeImmutable */
    private $cacheDate;
    /** @var DateInterval */
    private $ttl;

    public function __construct(Weather $weather, \DateTimeImmutable $cacheDate, \DateInterval $ttl) {
        $this->weather = $weather;
        $this->cacheDate = $cacheDate;
        $this->ttl = $ttl;
    }

    public function isPastTtl(): bool
    {
        $expirationDate = $this->cacheDate->add($this->ttl);
        $now = new \DateTimeImmutable();
        return $now > $expirationDate;
    }

    public function getWeather(): Weather
    {
        return $this->weather;
    }
}