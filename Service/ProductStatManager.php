<?php

namespace Dywee\ProductCMSBundle\Service;

use Doctrine\ORM\EntityManager;
use Dywee\ProductBundle\Entity\BaseProduct;
use Dywee\ProductBundle\Entity\ProductStat;
use Dywee\ProductBundle\Service\SessionManager;
use Dywee\ProductCMSBundle\DyweeProductCMSEvent;
use Dywee\ProductCMSBundle\Event\ProductStatEvent;

class ProductStatManager{

    private $em;
    private $sessionManager;

    public function __construct(EntityManager $entityManager, SessionManager $sessionManager)
    {
        $this->em = $entityManager;
        $this->sessionManager = $sessionManager;
    }

    public function handleEvent(ProductStatEvent $event)
    {
        switch($event->getEvent())
        {
            case DyweeProductCMSEvent::PRODUCT_PAGE_DISPLAY:
                return $this->createStatForDisplay($event->getProduct());
            case  DyweeProductCMSEvent::PRODUCT_ADD_TO_BASKET:
                return $this->createStatForBasket($event->getProduct(), $event->getQuantity());
            case DyweeProductCMSEvent::PRODUCT_PURCHASED:
                return $this->createStatForOrder($event->getProduct(), $event->getQuantity());
        }
    }

    public function createStatForDisplay(BaseProduct $product)
    {
        $productStatRepository = $this->em->getRepository('DyweeProductBundle:ProductStat');

        $productStat = $productStatRepository->retrievedStatForProduct($product, ProductStat::TYPE_DISPLAY, $this->sessionManager->getTrackingKey());

        if(count($productStat) > 0){
            $productStat = $productStat[0];
            $productStat->setAttempts($productStat->getAttempts() + 1);
        }
        else{
            $productStat = new ProductStat();
            $productStat->setProduct($product);
            $productStat->setQuantity(1);
            $productStat->setType(ProductStat::TYPE_DISPLAY);
            $productStat->setTrackingKey($this->sessionManager->getTrackingKey());
        }

        $this->em->persist($productStat);
        $this->em->flush();
    }

    public function createStatForBasket(BaseProduct $product, $quantity)
    {
        $productStatRepository = $this->em->getRepository('DyweeProductBundle:ProductStat');
        $productStat = $productStatRepository->retrievedStatForProduct($product, ProductStat::TYPE_DISPLAY, $this->sessionManager->getTrackingKey());

        if(count($productStat) > 0){
            $productStat = $productStat[0];
            $productStat->setAttempts($productStat->getAttempts() + 1);
        }
        else {
            $productStat = new ProductStat();
            $productStat->setProduct($product);
            $productStat->setQuantity($quantity);
            $productStat->setType(ProductStat::TYPE_ADD_TO_BASKET);
            $productStat->setTrackingKey($this->sessionManager->getTrackingKey());
        }

        $this->em->persist($productStat);
        $this->em->flush();
    }

    public function createStatForOrder(BaseProduct $product, $quantity)
    {
        $productStatRepository = $this->em->getRepository('DyweeProductBundle:ProductStat');
        $productStat = $productStatRepository->retrievedStatForProduct($product, ProductStat::TYPE_DISPLAY, $this->sessionManager->getTrackingKey());

        if(count($productStat) > 0){
            $productStat = $productStat[0];
            $productStat->setAttempts($productStat->getAttempts() + 1);
        }
        else {
            $productStat = new ProductStat();
            $productStat->setProduct($product);
            $productStat->setQuantity($quantity);
            $productStat->setType(ProductStat::TYPE_BUY);
            $productStat->setTrackingKey($this->sessionManager->getTrackingKey());
        }

        $this->em->persist($productStat);
        $this->em->flush();
        $this->sessionManager->removeTrackingKey();
    }

    public function getForProduct(BaseProduct $product)
    {
        return $this->getForProductAndTimeRange($product);
    }

    public function getForProductAndTimeRange(BaseProduct $product, $beginAt = null, $endAt = null, $timeScale = 'day')
    {
        if(!$beginAt)
            $beginAt = new \DateTime('last month');
        if(!$endAt)
            $endAt = new \DateTime();

        $psr = $this->em->getRepository('DyweeProductBundle:ProductStat');

        $types = array(
            ProductStat::TYPE_DISPLAY,
            ProductStat::TYPE_ADD_TO_BASKET,
            ProductStat::TYPE_BUY,
        );


        $rawStats = $psr->getStats($product, $types, $beginAt, $endAt, $timeScale);

        $stats = array();

        $date = clone $beginAt;

        $diff = (int) $endAt->diff($beginAt)->format('%a');

        for($i = 0; $i < $diff; $i++)
        {
            $key = $date->modify('+1 day')->format('d/m/Y');
            $stats[$key] = array(
                'createdAt' => $date->format('d/m'));

            foreach($types as $type)
                $stats[$key][$type] = 0;
        }

        foreach($rawStats as $stat)
            $stats[$stat['createdAt']->format('d/m/Y')][$stat['type']] = $stat['total'];

        return $stats;
    }

}