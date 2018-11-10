<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

trait ResponsesTrait
{
    private function noContentResponse()
    {
        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
        return $response;
    }

    private function forbiddenResponse()
    {
        $response = new Response();
        $response->setStatusCode(Response::HTTP_FORBIDDEN);
        return $response;
    }
}