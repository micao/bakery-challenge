<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class Eclairs extends Cake
{
    public function __construct()
    {
        Parent::__construct('ECLAIRS', 'CHOUX PASTRY', 'CHOCOLATE', 'BUTTER CREME', 'PLAIN');
    }

    public static function checkPossible($pastry, $topping, $filling, $flavor)
    {
        $response = [
            'success' => true,
            'error' => null,
        ];
        if ($pastry && strtolower($pastry) != 'choux pastry') {
            $response['success'] = false;
            $response['error'] = 'Choice of pastry is not exist !';
        }

        if ($topping && strtolower($topping) != 'chocolate') {
            $response['success'] = false;
            $response['error'] = 'Choice of topping is not exist !';
        }

        if ($filling && !in_array(strtolower($filling), ['butter creme', 'whipped creme'])) {
            $response['success'] = false;
            $response['error'] = 'Choice of filling is not exist !';
        }

        if ($flavor && !in_array(strtolower($flavor), ['coffee', 'lemon', 'orange', 'vanilla'])) {
            $response['success'] = false;
            $response['error'] = 'Choice of flavor is not exist !';
        }

        return $response;
    }
}