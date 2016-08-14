<?php

namespace Dywee\ProductCMSBundle\Controller;

use Dywee\ProductCMSBundle\Entity\LatestProductContainer;
use Dywee\ProductCMSBundle\Form\LatestProductContainerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LatestProductContainerController extends Controller
{
    public function installAction()
    {
        $latestProductContainer = new LatestProductContainer();
        $em = $this->getDoctrine()->getManager();
        $em->persist($latestProductContainer);
        $em->flush();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/admin/productCMS/latestProducts", name="product_cms_latest_products")
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DyweeProductCMSBundle:LatestProductContainer');
        $object = $repository->findOneBy(array('id' => 1));

        if(!$object)
            $object = new LatestProductContainer();

        $form = $this->createForm(LatestProductContainerType::class, $object);

        if($form->handleRequest($request)->isValid())
        {
            $request->getSession()->getFlashbag()->set('success', 'Bien enregistré');
            $em->persist($object);
            $em->flush();
        }

        return $this->render('DyweeProductCMSBundle:LatestProductContainer:edit.html.twig', array('form' => $form->createView()));
    }
}
