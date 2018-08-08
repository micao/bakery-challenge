<?php

namespace Optimy\OnlineBakery;


use Ramsey\Uuid\Uuid;

class InFileOrderRepository
{

    private const DIRECTORY = 'storage';
    private const FILE_SUFFIX = '.store';

    public function save(Distinguishable $order)
    {

        if($order->getId() === null){
            $order->setId(Uuid::uuid4()->toString());
        }

        file_put_contents($this->composeFileNameFor($order->getId()), serialize($order));
    }

    public function load(string $orderId)
    {
        $fileName = $this->composeFileNameFor($orderId);

        return unserialize(file_get_contents($fileName));
    }

    private function composeFileNameFor(string $orderId)
    {
        $fileName = $orderId . static::FILE_SUFFIX;

        return join([__DIR__, static::DIRECTORY, $fileName], '/');
    }

}
