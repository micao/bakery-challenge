<?php

namespace Optimy\OnlineBakery;

use Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;

class WelcomeController
{

    public function welcome(Request $request, Application $app)
    {
        $responseBody = [
            'message' => "Welcome, this is your online bakery talking!",
            'user_ip' => $request->getClientIp()
        ];

        return new JsonResponse($responseBody, Response::HTTP_OK);
    }
}
