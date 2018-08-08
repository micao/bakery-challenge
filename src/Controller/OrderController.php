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
use Optimy\OnlineBakery\Model\OrderStatus;
use Optimy\OnlineBakery\InFileOrderRepository;

class OrderController
{
    const NUM_OF_PROPOSED_CAKE = 10;
    const TYPE_OF_CAKES = ['Cupcakes','Eclairs','MilleFeuilles','CheeseCake'];
    const TYPE_OF_TOPPING = ['ICING', 'BUTTER CREME', 'WHIPPED CREME'];
    const TYPE_OF_CREME = ['BUTTER CREME','WHIPPED CREME'];
    const TYPE_OF_FLAVOR = ['PLAIN', 'COFFEE', 'LEMON', 'ORANGE', 'VANILLA'];

    private $order;

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

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
        try {
            $order = new Order();
            $order->setDetail($preOrder);
            $order->setStatus(OrderStatus::STATUS_ORDERED);
            $order->setStatusCode(OrderStatus::CODE[OrderStatus::STATUS_ORDERED]);

            $this->order = $order;

            $fp = new InFileOrderRepository();
            $fp->save($order);
        } catch (Exception $e) {
            error_log(print_r($e->getMessage(), true));
        }
    }

    private function findOrderById($orderId)
    {
        try {
            $fp = new InFileOrderRepository();
            $orderObj = $fp->load($orderId);
            if ($orderObj instanceof Order) {
                return $orderObj;
            } else {
                return null;
            }
        } catch (Exception $e) {
            error_log(print_r($e->getMessage(), true));
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
        $responseBody = [];
        $data = null;
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = $request->getContent();
        }
        $data = json_decode($data);
        foreach ($data as $row) {
            switch (strtolower($row->type)) {
                case 'cheesecake':
                    $return = CheeseCake::checkPossible($row->pastry, $row->topping, $row->filling, $row->cremeFlavor);
                    if (!$return['success']) {
                        $responseBody[] = $return['error'];
                        $responseBody[] = $row->type;
                        return new JsonResponse($responseBody, Response::HTTP_OK);
                    }
                    break;
                case 'cupcakes':
                    $return = Cupcakes::checkPossible($row->pastry, $row->topping, $row->filling, $row->cremeFlavor);
                    if (!$return['success']) {
                        $responseBody[] = $return['error'];
                        $responseBody[] = $row->type;
                        return new JsonResponse($responseBody, Response::HTTP_OK);
                    }
                    break;
                case 'eclairs':
                    $return = Eclairs::checkPossible($row->pastry, $row->topping, $row->filling, $row->cremeFlavor);
                    if (!$return['success']) {
                        $responseBody[] = $return['error'];
                        $responseBody[] = $row->type;
                        return new JsonResponse($responseBody, Response::HTTP_OK);
                    }
                    break;
                case 'millefeuilles':
                    $return = MilleFeuilles::checkPossible($row->pastry, $row->topping, $row->filling, $row->cremeFlavor);
                    if (!$return['success']) {
                        $responseBody[] = $return['error'];
                        $responseBody[] = $row->type;
                        return new JsonResponse($responseBody, Response::HTTP_OK);
                    }
                    break;
            }
        }
        $responseBody = $data;
        $this->createOrder($responseBody);
        return new JsonResponse($responseBody, Response::HTTP_OK);
    }

    /**
     * GET /api/cakes/order/{order_id}
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function checkOrderById($order_id, Request $request, Application $app)
    {
        $responseBody = [];
        $order = $this->findOrderById($order_id);
        if ($order) {
            $responseBody = $order->getDetail();
        }
        return new JsonResponse($responseBody, Response::HTTP_OK);
    }

    /**
     * PUT /api/cakes/order/{order_id}
     * @param Request     $request
     * @param Application $app
     * @return JsonResponse
     */
    public function changeOrderById($order_id, Request $request, Application $app)
    {
        $responseBody = [];
        $order = $this->findOrderById($order_id);
        if ($order) {
            $order->setStatus(OrderStatus::STATUS_ONGOING);
            $order->setStatusCode(OrderStatus::CODE[OrderStatus::STATUS_ONGOING]);
            $responseBody[] = $order->getDetail();
            $responseBody[] = $order->getStatus();
        }
        return new JsonResponse(null, Response::HTTP_OK);
    }
}