<?php

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Service\WeatherService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\WeatherProvider\WeatherProviderConfiguration;
use AppBundle\Service\WeatherProvider\OpenWeatherMap\OpenWeatherMapClient;

class WeatherProviderConfigurationController extends Controller
{
    /**
     * @Route("/admin/provider/all", name="provider_keys", methods={"GET"})
     */
    public function getAllKeys(WeatherProviderConfiguration $configuration)
    {
        return $this->json($configuration->providerKeys());
    }

    /**
     * @Route("/admin/provider/current", name="get_current_provider", methods={"GET"})
     */
    public function getCurrentKey(WeatherProviderConfiguration $configuration)
    {
        return $this->json($configuration->getProviderKey());
    }

    /**
     * @Route("/admin/provider/current", name="set_current_provider", methods={"POST"})
     */
    public function setCurrentKey(WeatherProviderConfiguration $configuration, Request $request)
    {
        $key = $request->request->get('key');
        $configuration->setProviderByKey($key);
        return $this->noContentResponse();
    }

    private function noContentResponse()
    {
        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
        return $response;
    }
}