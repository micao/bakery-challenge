<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class Cupcakes extends Cake
{
    public function __construct()
    {
        Parent::__construct('CUPCAKES', ['SPONGE'], ['ICING', 'BUTTER CREME', 'WHIPPED CREME',], []);
    }
}