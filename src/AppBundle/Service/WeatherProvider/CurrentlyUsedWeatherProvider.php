<?php

namespace AppBundle\Service\WeatherProvider;

use AppBundle\Entity\City;
use AppBundle\Service\WeatherProvider\Weather;
use AppBundle\Service\WeatherProvider\WeatherProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Service\WeatherProvider\WeatherProviderConfiguration;
use Symfony\Component\Cache\Simple\FilesystemCache;

class CurrentlyUsedWeatherProvider implements WeatherProvider, WeatherProviderConfiguration
{
    /** @var ContainerInterface */
    private $container;
    /** @var MemcachedCache */
    private $cache;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->cache = new FilesystemCache();
    }

    public function currentWeather(City $city): Weather
    {
        return $this->current()->currentWeather($city);
    }

    private function current(): WeatherProvider
    {
        $key = $this->getProviderKey();
        return $this->container->get('provider.' . $key);
    }

    /** @return string[] */
    public function providerKeys()
    {
        return ['openWeatherMap', 'dummy'];
    }

    public function setProviderByKey(string $key)
    {
        $this->cache->set('provider_key', $key);
    }

    public function getProviderKey()
    {
        return $this->cache->has('provider_key') ? $this->cache->get('provider_key') : 'dummy';
    }
} 