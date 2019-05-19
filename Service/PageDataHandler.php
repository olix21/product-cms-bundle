<?php

namespace Dywee\ProductCMSBundle\Service;

use Symfony\Component\Routing\Router;

class PageDataHandler
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function addDataToNavbar()
    {
        return array('pageList' => array(

            $this->router->generate('eshop')
        ));
    }

    public function addDataToFooter()
    {
        return array('pageList' => $this->router->generate('eshop'));
    }
}
