<?php

namespace AppBundle\Service\WeatherCache;

use Symfony\Component\Cache\Simple\FilesystemCache;
use AppBundle\Service\WeatherProvider\Weather;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;


class WeatherCache
{
    /** @var \DateInterval */
    private $ttl;
    /** @var FilesystemCache */
    private $cache;
    
    public function __construct($ttlMinutes, $cache = null) {
        $this->ttl = new \DateInterval('PT' . $ttlMinutes . 'M');
        $this->cache = $cache == null ? new FilesystemCache('weather_cache') : $cache;
    }

    public function cacheIfNeeded($cityId, Weather $weather)
    {
        if ($this->shouldCache($cityId)) {
            $key = $this->key($cityId);
            $cachedWeather = new CachedWeather($weather, $this->now(), $this->ttl);
            $this->cache->set($key, $cachedWeather);
        }
    }

    public function get($cityId)
    {
        $key = $this->key($cityId);
        return $this->cache->get($key)->getWeather();
    }

    private function shouldCache($cityId)
    {
        $key = $this->key($cityId);
        return (!$this->cache->has($key)) || ($this->cache->get($key)->isPastTtl());
    }

    private function key($cityId)
    {
        return 'weather_city_' . $cityId;
    }

    private function now()
    {
        return new \DateTimeImmutable();
    }
}