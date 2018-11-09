<?php

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CitiesController extends Controller
{
    /**
     * @Route("/city/all", name="all_cities", methods={"GET"})
     */
    public function allAction(CitiesService $citiesService)
    {
        $cities = $citiesService->allCities();
        $response = [];
        foreach ($cities as $city) {
            array_push($response, $this->cityToArray($city));
        }
        return $this->json($response);
    }

    private function cityToArray(City $city)
    {
        return [
            'name' => $city->getCityName(),
            'countryCode' => $city->getContryCode(),
        ];
    }
}
