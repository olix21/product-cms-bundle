<?php

namespace Dywee\ProductCMSBundle\Service;

use Symfony\Component\Routing\RouterInterface;

class PageDataHandler
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function addDataToNavbar()
    {
        return [
            'pageList' => [

                $this->router->generate('eshop'),
            ],
        ];
    }

    public function addDataToFooter()
    {
        return ['pageList' => $this->router->generate('eshop')];
    }

}
