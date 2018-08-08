<?php

namespace Optimy\OnlineBakery;


interface Distinguishable
{

    /**
     * @return null|string
     */
   public function getId(): ?string;

    /**
     * @param string $id
     */
   public function setId(string $id): void;

}
