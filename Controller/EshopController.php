<?php

namespace Dywee\ProductCMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EshopController extends AbstractController
{
    /**
     * @Route(name="eshop", path="eshop")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('DyweeProductBundle:Product')->findBy(array(), array(), 9);
        $categories = $em->getRepository('DyweeProductBundle:Category')->findBy(array(), array());

        return $this->render('@DyweeProductCMSBundle/Eshop/index.html.twig', array(
            'products' => $products,
            'categories' => $categories
        ));
    }
}
