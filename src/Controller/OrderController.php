<?php

namespace Optimy\OnlineBakery\Controller;

use Silex\Application;
use Symfony\Component\Config\Definition\Exception\Exception;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;
use Optimy\OnlineBakery\Model\Cakes\Cupcakes as Cupcakes;
use Optimy\OnlineBakery\Model\Cakes\Eclairs as Eclairs;
use Optimy\OnlineBakery\Model\Cakes\MilleFeuilles as MilleFeuilles;
use Optimy\OnlineBakery\Model\Cakes\CheeseCake as CheeseCake;
use Optimy\OnlineBakery\Model\Order;

class OrderController
{
    const NUM_OF_PROPOSED_CAKE = 10;
    const TYPE_OF_CAKES = ['Cupcakes','Eclairs','MilleFeuilles','CheeseCake'];
    const TYPE_OF_TOPPING = ['ICING', 'BUTTER CREME', 'WHIPPED CREME'];
    const TYPE_OF_CREME = ['BUTTER CREME','WHIPPED CREME'];
    const TYPE_OF_FLAVOR = ['PLAIN', 'COFFEE', 'LEMON', 'ORANGE', 'VANILLA'];

    /**
     * Return instance of a class by argument
     * @param $className
     * @return CheeseCake|Cupcakes|Eclairs|MilleFeuilles|\stdClass
     */
    private function returnClass($className)
    {
        switch (strtolower($className)) {
            case 'cupcakes':
                return new Cupcakes();
            case 'eclairs':
                return new Eclairs();
            case 'millefeuilles':
                return new MilleFeuilles();
            case 'cheesecake':
                return new CheeseCake();
            default:
                return new \stdClass();
        }
    }

    private function createOrder($preOrder)
    {
        $order = new Order();
        $
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
    public function proposeTenCakesByType($type, Request $request, Application $app)
    {
        $responseBody = [];
        switch (strtolower($type)) {
            case 'cupcakes':
                for($i = 0 ; $i<self::NUM_OF_PROPOSED_CAKE ; $i++) {
                    $topping = self::TYPE_OF_TOPPING[rand(0, count(self::TYPE_OF_TOPPING) - 1)];
                    $flavor = self::TYPE_OF_FLAVOR[rand(0, count(self::TYPE_OF_FLAVOR) - 1)];
                    $tmp = new Cupcakes();
                    $tmp->setTopping($topping);
                    $tmp->setCremeFlavor($flavor);
                    $responseBody[] = $tmp->toArray();
                }
                break;
            case 'eclairs':
                for($i = 0 ; $i<self::NUM_OF_PROPOSED_CAKE ; $i++) {
                    $filling = self::TYPE_OF_CREME[rand(0, count(self::TYPE_OF_CREME) - 1)];
                    $flavor = self::TYPE_OF_FLAVOR[rand(0, count(self::TYPE_OF_FLAVOR) - 1)];
                    $tmp = new Eclairs();
                    $tmp->setFilling($filling);
                    $tmp->setCremeFlavor($flavor);
                    $responseBody[] = $tmp->toArray();
                }
                break;
            case 'millefeuilles':
                for($i = 0 ; $i<self::NUM_OF_PROPOSED_CAKE ; $i++) {
                    $filling = self::TYPE_OF_CREME[rand(0, count(self::TYPE_OF_CREME) - 1)];
                    $flavor = self::TYPE_OF_FLAVOR[rand(0, count(self::TYPE_OF_FLAVOR) - 1)];
                    $tmp = new MilleFeuilles();
                    $tmp->setFilling($filling);
                    $tmp->setCremeFlavor($flavor);
                    $responseBody[] = $tmp->toArray();
                }
                break;
            case 'cheesecake':
                for($i = 0 ; $i<self::NUM_OF_PROPOSED_CAKE ; $i++) {
                    $flavor = self::TYPE_OF_FLAVOR[rand(0, count(self::TYPE_OF_FLAVOR) - 1)];
                    $tmp = new CheeseCake();
                    $tmp->setCremeFlavor($flavor);
                    $responseBody[] = $tmp->toArray();
                }
                break;
            default:
                $responseBody[] = "Attention : No type found !";
        }
        return new JsonResponse($responseBody, Response::HTTP_OK);
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