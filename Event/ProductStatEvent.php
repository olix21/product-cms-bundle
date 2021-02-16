<?php

namespace Dywee\ProductCMSBundle\Event;

use Dywee\ProductBundle\Entity\BaseProduct;
use Symfony\Contracts\EventDispatcher\Event;

class ProductStatEvent extends Event
{
    private $product;
    private $event;
    private $quantity;

    public function __construct(BaseProduct $product, $event, $quantity = 1)
    {
        $this->product = $product;
        $this->event = $event;
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
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
