<?php

namespace Optimy\OnlineBakery\Services;

class Cake
{
    private $type;

    private $pastry;

    private $topping;

    private $filling;

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
}