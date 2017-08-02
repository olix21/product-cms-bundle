<?php

namespace Dywee\ProductCMSBundle\Listener;

use Dywee\ProductCMSBundle\Service\ProductCMSAdminSidebarHandler;
use Dywee\CoreBundle\DyweeCoreEvent;
use Dywee\CoreBundle\Event\SidebarBuilderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class AdminSidebarBuilderListener implements EventSubscriberInterface{
    private $ProductCMSAdminSidebarHandler;

    public function __construct(ProductCMSAdminSidebarHandler $CMSAdminSidebarHandler)
    {
        $this->ProductCMSAdminSidebarHandler = $CMSAdminSidebarHandler;
    }


    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            DyweeCoreEvent::BUILD_ADMIN_SIDEBAR => array('addElementToSidebar', -15)
        );
    }

    public function addElementToSidebar(SidebarBuilderEvent $adminSidebarBuilderEvent)
    {
        $adminSidebarBuilderEvent->addElement($this->ProductCMSAdminSidebarHandler->getSideBarMenuElement());
    }

}