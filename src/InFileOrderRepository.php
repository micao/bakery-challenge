<?php

namespace Optimy\OnlineBakery;


use Ramsey\Uuid\Uuid;

class InFileOrderRepository
{

    const DIRECTORY = 'storage';
    const FILE_SUFFIX = '.store';

    public function save(Distinguishable $order)
    {

        if($order->getId() === null){
            $order->setId(Uuid::uuid4()->toString());
        }

        file_put_contents($this->composeFileNameFor($order->getId()), serialize($order));
    }

    public function load($orderId)
    {
        $fileName = $this->composeFileNameFor($orderId);

        return unserialize(file_get_contents($fileName));
    }

    private function composeFileNameFor($orderId)
    {
        $fileName = $orderId . static::FILE_SUFFIX;

        return join([__DIR__, static::DIRECTORY, $fileName], '/');
    }

}
