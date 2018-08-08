<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class CheeseCake extends Cake
{
    public function __construct()
    {
        Parent::__construct('CHEESECAKE', 'SHORTCRUST', null, 'CHEESE CAKE CREME', 'PLAIN');
    }

    public static function checkPossible($pastry, $topping, $filling, $flavor)
    {
        $response = [
            'success' => true,
            'error' => null,
        ];
        if ($pastry && strtolower($pastry) != 'shortcrust') {
            $response['success'] = false;
            $response['error'] = 'Choice of pastry is not exist !';
        }

        if ($topping) {
            $response['success'] = false;
            $response['error'] = 'No topping to choose for CheeseCake !';
        }

        if ($filling && strtolower($filling) != 'cheese cake creme') {
            $response['success'] = false;
            $response['error'] = 'Choice of filling is not exist !';
        }

        if ($flavor && !in_array(strtolower($flavor), ['plain', 'coffee', 'lemon', 'orange', 'vanilla'])) {
            $response['success'] = false;
            $response['error'] = 'Choice of flavor is not exist !';
        }

        return $response;
    }
}