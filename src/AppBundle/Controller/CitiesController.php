<?php

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Service\CitiesService;
use AppBundle\Controller\ResponsesTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CitiesController extends Controller
{
    use ResponsesTrait;

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

    /**
     * @Route("/admin/city/add", name="add_city", methods={"POST"})
     */
    public function addAction(CitiesService $citiesService, Request $request)
    {
       $citiesService->add(
           $request->request->get('name'),
           $request->request->get('countryCode')
       ); 
       return $this->noContentResponse();
    }

    /**
     * @Route("/admin/city/remove/{id}", name="remove_city", methods={"POST"})
     */
    public function removeAction($id, CitiesService $citiesService)
    {
       $citiesService->removeById($id);
       return $this->noContentResponse();
    }

    private function cityToArray(City $city)
    {
        return [
            'name' => $city->getCityName(),
            'countryCode' => $city->getContryCode(),
        ];
    }
}
