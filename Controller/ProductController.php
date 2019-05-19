<?php

namespace Dywee\ProductCMSBundle\Controller;

use Dywee\ProductBundle\Entity\BaseProduct;
use Dywee\ProductCMSBundle\DyweeProductCMSEvent;
use Dywee\ProductCMSBundle\Event\ProductStatEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route(name="product_cms_preview", path="product/{id}/preview")
     */
    public function previewAction(BaseProduct $baseProduct)
    {
        return $this->render('DyweeProductCMSBundle:BaseProduct:preview.html.twig', array('product' => $baseProduct));
    }

    /**
     * @Route(name="product_cms_view", path="product/{id}", requirements={"id": "\d+"})
     */
    public function viewAction(BaseProduct $baseProduct, Request $request)
    {
        $defaultData = array('quantity' => 1);
        $form = $this->createFormBuilder($defaultData)
            ->add('quantity', NumberType::class)
            ->add('purchase', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        $event = new ProductStatEvent($baseProduct, DyweeProductCMSEvent::PRODUCT_PAGE_DISPLAY);

        if ($form->isValid()) {
            $quantity = $form->getData()['quantity'];

            $this->get('event_dispatcher')->dispatch(
                DyweeProductCMSEvent::PRODUCT_ADD_TO_BASKET,
                $event->setEvent(DyweeProductCMSEvent::PRODUCT_ADD_TO_BASKET)
                    ->setQuantity($quantity)
            );

            return $this->forward('DyweeOrderCMSBundle:Basket:add', array(
                'id' => $baseProduct->getId(),
                'quantity' => $quantity
            ));
        }


        $this->get('event_dispatcher')->dispatch(DyweeProductCMSEvent::PRODUCT_PAGE_DISPLAY, $event);

        return $this->render('DyweeProductCMSBundle:Product:view.html.twig', array(
            'product' => $baseProduct,
            'form' => $form->createView()
        ));
    }

    public function listAction()
    {
        $productRespository = $this->getDoctrine()->getRepository('DyweeProductBundle:BaseProduct');
        return $this->render('DyweeProductCMSBundle:BaseProduct:list.html.twig');
    }
}
