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
    
    /**
     * @Route("/login/login-success", name="login_success")
     */
    public function loginSuccess()
    {
        return $this->noContentResponse();
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login()
    {
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/logout-success", name="logout_success")
     */
    public function logoutSuccess()
    {
        return $this->json('logged out');
    }

    /**
     * @Route("/access-denied", name="access_denied")
     */
    public function accessDenied()
    {
        return $this->forbiddenResponse();
    }

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
