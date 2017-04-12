<?php

namespace Dywee\ProductCMSBundle\Service;

use Symfony\Component\Routing\Router;

class ProductCMSAdminSidebarHandler{

    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getSideBarMenuElement()
    {
        /*
        $menu = array(
            'key' => 'cms',
            'children' => array(
                5 => array(
                    'icon' => 'fa fa-list-alt',
                    'label' => 'Produits à la une',
                    'route' => $this->router->generate('product_cms_latest_products')
                ),
                10 => array(
                    'icon' => 'fa fa-list-alt',
                    'label' => 'Gallerie de produit',
                    'route' => $this->router->generate('product_gallery_table')
                ),
            )
        );

        return $menu;
        */
    }
}