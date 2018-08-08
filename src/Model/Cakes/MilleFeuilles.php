<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class MilleFeuilles extends Cake
{
    public function __construct()
    {
        Parent::__construct('MILLE-FEUILLES', ['PUFF PASTRY'], ['FRUITS'], ['BUTTER CREME','WHIPPED CREME']);
    }
}