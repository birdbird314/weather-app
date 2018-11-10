<?php

namespace AppBundle\Controller;

use AppBundle\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthController extends Controller
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(UserService $userService, Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $userService->register($username, $password);
        return $this->noContentResponse();
    }

    private function noContentResponse()
    {
        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
        return $response;
    }
}
