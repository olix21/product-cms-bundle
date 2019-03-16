<?php

namespace Dywee\ProductCMSBundle\Service;

use Symfony\Component\Routing\RouterInterface;

class ProductCMSAdminSidebarHandler
{

    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getSideBarMenuElement()
    {
        $menu = [
            'key'      => 'cms',
            'children' => [
                5  => [
                    'icon'  => 'fa fa-list-alt',
                    'label' => 'Container de produits',
                    'route' => $this->router->generate('product_container_admin_list'),
                ],
                10 => [
                    'icon'  => 'fa fa-list-alt',
                    'label' => 'Gallerie de produit',
                    'route' => $this->router->generate('product_gallery_table'),
                ],
            ],
        ];

        return $menu;
    }
}