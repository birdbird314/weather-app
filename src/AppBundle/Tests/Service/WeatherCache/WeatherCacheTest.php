<?php

namespace AppBundle\Service\WeatherCache;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\WeatherProvider\Weather;
use Symfony\Component\Cache\Simple\FilesystemCache;


class WeatherCacheTest extends TestCase
{
    /** @var FilesystemCache */
    private $filesysCache;

    public function __construct() {
        $this->filesysCache = new FilesystemCache('test_weather');
        parent::__construct();
    }

    protected function tearDown()
    {
        $this->filesysCache->clear();
    }

    public function testShouldNotCacheValueWhenPreviousOneIsNotPastTtl()
    {
        $weatherCache = new WeatherCache(999, $this->filesysCache);
        $weather = (new Weather())->setTemperature(0);
        $newWeather = (new Weather())->setTemperature(1);
        $someCityId = 1;
        $weatherCache->cacheIfNeeded($someCityId, $weather);

        $weatherCache->cacheIfNeeded($someCityId, $newWeather);

        $this->assertEquals(
            $weather,
            $weatherCache->get($someCityId)
        );
    }

    public function testShouldCacheValueWhenPreviousOneIsPastTtl()
    {
        $weatherCache = new WeatherCache(0, $this->filesysCache);
        $weather = (new Weather())->setTemperature(0);
        $newWeather = (new Weather())->setTemperature(1);
        $someCityId = 1;
        $weatherCache->cacheIfNeeded($someCityId, $weather);

        $weatherCache->cacheIfNeeded($someCityId, $newWeather);

        $this->assertEquals(
            $newWeather,
            $weatherCache->get($someCityId)
        );
    }
}