<?php

namespace Dywee\ProductCMSBundle\Event;

use Dywee\ProductBundle\Entity\BaseProduct;
use Symfony\Component\EventDispatcher\Event;

class ProductStatEvent extends Event
{
    private $product;
    private $event;

    public function __construct(BaseProduct $product, $event)
    {
        $this->product = $product;
        $this->event = $event;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    public function getEvent()
    {
        return $this->event;
    }
}