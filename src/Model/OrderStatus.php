<?php

namespace Optimy\OnlineBakery\Model;

class OrderStatus
{
    const STATUS_FAIL = 'FAILURE';
    const STATUS_ORDERED = 'ORDERED';
    const STATUS_ONGOING = 'ONGOING';
    const STATUS_DELIVERED = 'DELIVERED';

    const CODE = [
        self::STATUS_FAIL => -1,
        self::STATUS_ORDERED => 0,
        self::STATUS_ONGOING => 1,
        self::STATUS_DELIVERED => 2,
    ];
}