<?php

namespace AppBundle\Service\WeatherProvider;

interface WeatherProviderConfiguration
{
    /** @return string[] */
    public function providerKeys();

    public function setProviderByKey(string $key);

    public function getProviderKey();
}