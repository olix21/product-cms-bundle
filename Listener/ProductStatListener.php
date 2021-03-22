<?php

namespace Dywee\ProductCMSBundle\Listener;

use Dywee\ProductCMSBundle\DyweeProductCMSEvent;
use Dywee\ProductCMSBundle\Event\ProductStatEvent;
use Dywee\ProductCMSBundle\Service\ProductStatManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Router;


class ProductStatListener implements EventSubscriberInterface
{
    private ProductStatManager $productStatManager;

    public function __construct(ProductStatManager $productStatManager)
    {
        $this->productStatManager = $productStatManager;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            DyweeProductCMSEvent::PRODUCT_PAGE_DISPLAY => array('handleStat'),
            DyweeProductCMSEvent::PRODUCT_ADD_TO_BASKET => array('handleStat'),
            DyweeProductCMSEvent::PRODUCT_PURCHASED => array('handleStat'),
            //TODO: listen to "Add to basket" and "validate order"
        );
    }

    public function handleStat(ProductStatEvent $productStatEvent)
    {
        $this->productStatManager->handleEvent($productStatEvent);
    }
}
