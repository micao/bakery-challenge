<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class Cupcakes extends Cake
{
    public function __construct()
    {
        Parent::__construct('CUPCAKES', 'SPONGE', 'ICING', null, 'PLAIN');
    }

    public static function checkPossible($pastry, $topping, $filling, $flavor)
    {
        $response = [
            'success' => true,
            'error' => null,
        ];
        if ($pastry && strtolower($pastry) != 'sponge') {
            $response['success'] = false;
            $response['error'] = 'Choice of pastry is not exist !';
        }

        if ($topping && !in_array(strtolower($topping), ['icing', 'butter creme', 'whipped creme'])) {
            $response['success'] = false;
            $response['error'] = 'Choice of topping is not exist !';
        }

        if ($filling) {
            $response['success'] = false;
            $response['error'] = 'No filling to choose for Cupcakes !';
        }

        if ($flavor && !in_array(strtolower($flavor), ['coffee', 'lemon', 'orange', 'vanilla'])) {
            $response['success'] = false;
            $response['error'] = 'Choice of flavor is not exist !';
        }

        return $response;
    }
}