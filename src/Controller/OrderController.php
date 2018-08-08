<?php

namespace Optimy\OnlineBakery\Controller;

use Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;
use Optimy\OnlineBakery\Model\Cakes\Cupcakes as Cupcakes;
use Optimy\OnlineBakery\Model\Cakes\Eclairs as Eclairs;
use Optimy\OnlineBakery\Model\Cakes\MilleFeuilles as MilleFeuilles;
use Optimy\OnlineBakery\Model\Cakes\CheeseCake as CheeseCake;

class OrderController
{
    const NUM_OF_PROPOSED_CAKE = 10;
    const TYPE_OF_CAKES = ['Cupcakes','Eclairs','MilleFeuilles','CheeseCake'];

    private function returnClass($className)
    {
        switch ($className) {
            case 'Cupcakes':
                return new Cupcakes();
            case 'Eclairs':
                return new Eclairs();
            case 'MilleFeuilles':
                return new MilleFeuilles();
            case 'CheeseCake':
                return new CheeseCake();
            default:
                return new \stdClass();
        }
    }

    /**
     * GET /api/cakes
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function proposeTenCakes(Request $request, Application $app)
    {
        $responseBody = [];
        for($i = 0 ; $i<self::NUM_OF_PROPOSED_CAKE ; $i++) {
            $randomNum = rand(0, (count(self::TYPE_OF_CAKES) - 1));
            $className = (String)self::TYPE_OF_CAKES[$randomNum];
            $tmp = $this->returnClass($className);
            $responseBody[] = $tmp->toArray();
        }

        return new JsonResponse($responseBody, Response::HTTP_OK);
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