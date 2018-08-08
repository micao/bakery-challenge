<?php

namespace Optimy\OnlineBakery;


interface Distinguishable
{

    /**
     * @return null|string
     */
   public function getId();

    /**
     * @param string $id
     */
   public function setId($id);

}
