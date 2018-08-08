<?php

namespace Optimy\OnlineBakery\Model\Cakes;

use Optimy\OnlineBakery\Model\Cake;

class CheeseCake extends Cake
{
    public function __construct()
    {
        Parent::__construct('CHEESECAKE', ['SHORTCRUST'], [], ['CHEESE CAKE CREME']);
    }
}