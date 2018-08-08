<?php

namespace Optimy\OnlineBakery\Model;

class Cake
{
    protected $type;

    protected $pastry;

    protected $topping;

    protected $filling;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPastry()
    {
        return $this->pastry;
    }

    /**
     * @param mixed $pastry
     */
    public function setPastry($pastry)
    {
        $this->pastry = $pastry;
    }

    /**
     * @return mixed
     */
    public function getTopping()
    {
        return $this->topping;
    }

    /**
     * @param mixed $topping
     */
    public function setTopping($topping)
    {
        $this->topping = $topping;
    }

    /**
     * @return mixed
     */
    public function getFilling()
    {
        return $this->filling;
    }

    /**
     * @param mixed $filling
     */
    public function setFilling($filling)
    {
        $this->filling = $filling;
    }

    public function __construct($type, $pastry, $topping, $filling)
    {
        $this->type = $type;
        $this->pastry = $pastry;
        $this->topping = $topping;
        $this->filling = $filling;
    }

    public function toArray()
    {
        return [
            'type'      => $this->type,
            'pastry'    => $this->pastry,
            'topping'   => $this->topping,
            'filling'   => $this->filling,
        ];
    }
}