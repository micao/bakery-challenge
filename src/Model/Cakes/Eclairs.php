<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class Eclairs extends Cake
{
    public function __construct()
    {
        Parent::__construct('ECLAIRS', ['CHOUX PASTRY'], ['CHOCOLATE'], ['BUTTER CREME','WHIPPED CREME']);
    }
}