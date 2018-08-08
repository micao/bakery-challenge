<?php

namespace Optimy\OnlineBakery\Model;

use \Optimy\OnlineBakery\Distinguishable as Distinguishable;

class Order implements Distinguishable
{
    private $orderId;

    private $detail;

    private $status;

    private $statusCode;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->orderId;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->orderId = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param $detail
     * @return $this
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}