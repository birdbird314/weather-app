<?php

namespace AppBundle\Service\WeatherCache;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\WeatherProvider\Weather;

class CachedWeatherTest extends TestCase
{
    public function test_shouldExecute()
    {
        $this->assertTrue(true);
    }

    public function testShouldReturnFalseWhenIntervalIsSmallerThanTtl()
    {
        $nowMinusThreeMinutes = (new \DateTimeImmutable())->modify('- 3 minute');
        $fiveMinutesTtl = new \DateInterval('PT5M');
        $cachedWeather = new CachedWeather(new Weather(), $nowMinusThreeMinutes, $fiveMinutesTtl);

        $isPastTtl = $cachedWeather->isPastTtl();

        $this->assertFalse($isPastTtl);
    }

    public function testShouldReturnTrueWhenIntervalIsGreaterThanTtl()
    {
        $nowMinusTenMinutes = (new \DateTimeImmutable())->modify('- 10 minute');
        $fiveMinutesTtl = new \DateInterval('PT5M');
        $cachedWeather = new CachedWeather(new Weather(), $nowMinusTenMinutes, $fiveMinutesTtl);

        $isPastTtl = $cachedWeather->isPastTtl();
        
        $this->assertTrue($isPastTtl);
    }
}