<?php

namespace Optimy\OnlineBakery\Controller;

use Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;

class OrderController
{
    /**
     * GET /api/cakes
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function proposeTenCakes(Request $request, Application $app)
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

    /**
     * GET /api/cakes/{type}
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function proposeTenCakesByType(Request $request, Application $app)
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }

    /**
     * POST /api/cakes/order
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function orderCakes(Request $request, Application $app)
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }

    /**
     * GET /api/cakes/order/{order_id}
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function checkOrderById(Request $request, Application $app)
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }

    /**
     * PUT /api/cakes/order/{order_id}
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function changeOrderById(Request $request, Application $app)
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }
}