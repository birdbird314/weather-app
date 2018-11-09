<?php

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\WeatherService;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\WeatherProvider\OpenWeatherMap\OpenWeatherMapClient;

class WeatherController extends Controller
{
    /**
     * @Route("/weather", name="current_weather", methods={"GET"})
     */
    public function currentWeatherAction(WeatherService $weatherService, Request $request)
    {
        $cityId = $request->query->get('cityId');
        $weather = $weatherService->currentWeather($cityId);
        return $this->json($weather->asArray());
    }
}