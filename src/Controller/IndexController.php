<?php

namespace Optimy\OnlineBakery\Controller;

use Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;

class IndexController
{

    public function index(Request $request, Application $app)
    {
        $responseBody = [
            'message' => "Welcome, this is home page!",
            'user_ip' => $request->getClientIp()
        ];
        /*
                if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                    $data = json_decode($request->getContent(), true);
                    $request->request->replace(is_array($data) ? $data : array());
                }
        */
        $post = array(
            'title' => $request->request->get('title'),
            'body' => $request->request->get('body'),
        );

        $responseBody = [
            'message' => "Welcome, this is home page!",
            'user_ip' => $request->getClientIp()
        ];

        return new JsonResponse($post, Response::HTTP_OK);
    }
}