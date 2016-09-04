<?php

namespace Dywee\ProductCMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EshopController extends Controller
{
    /**
     * @Route(name="eshop", path="eshop")
     */
    public function indexAction()
    {
        return new Response('eshop');
    }
}