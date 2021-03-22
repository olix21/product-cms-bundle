<?php

namespace Dywee\ProductCMSBundle\Listener;

use Dywee\CMSBundle\DyweeCMSEvent;
use Dywee\CMSBundle\Event\FooterBuilderEvent;
use Dywee\CMSBundle\Event\HomepageBuilderEvent;
use Dywee\CMSBundle\Event\NavbarBuilderEvent;
use Dywee\CMSBundle\Event\PageBuilderEvent;
use Dywee\ProductCMSBundle\Service\PageDataHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PageListener implements EventSubscriberInterface
{
    private PageDataHandler $pageDataHandler;

    public function __construct(PageDataHandler $pageDataHandler)
    {
        $this->pageDataHandler = $pageDataHandler;
    }


    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
           // DyweeCMSEvent::BUILD_PAGE       => array('addElementToPage'),
            //DyweeCMSEvent::BUILD_HOMEPAGE   => array('addElementToHomepage'),
            //DyweeCMSEvent::BUILD_NAVBAR   => array('addElementToNavbar'),
            //DyweeCMSEvent::BUILD_FOOTER   => array('addElementToFooter'),
        );
    }

    public function addElementToPage(PageBuilderEvent $pageBuilderEvent)
    {
        $pageBuilderEvent->addData($this->pageDataHandler->addDataToPage());
    }

    public function addElementToHomepage(HomepageBuilderEvent $homepageBuilderEvent)
    {
        $homepageBuilderEvent->addData($this->pageDataHandler->addDataToHomepage());
    }

    public function addElementToNavbar(NavbarBuilderEvent $navbarBuilderEvent)
    {
        $navbarBuilderEvent->addData($this->pageDataHandler->addDataToNavbar());
    }

    public function addElementToFooter(FooterBuilderEvent $footerBuilderEvent)
    {
        $footerBuilderEvent->addData($this->pageDataHandler->addDataToFooter());
    }
}
