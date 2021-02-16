<?php

namespace Dywee\ProductCMSBundle\Controller;

use Dywee\ProductCMSBundle\Entity\LatestProductContainer;
use Dywee\ProductCMSBundle\Form\LatestProductContainerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LatestProductContainerController extends AbstractController
{
    public function installAction()
    {
        $latestProductContainer = new LatestProductContainer();
        $em = $this->getDoctrine()->getManager();
        $em->persist($latestProductContainer);
        $em->flush();
    }

    /**
     * @Route(path="/admin/productCMS/latestProducts", name="product_cms_latest_products")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DyweeProductCMSBundle:LatestProductContainer');
        $object = $repository->findOneBy(['id' => 1]);

        if (!$object) {
            $object = new LatestProductContainer();
        }

        $form = $this->createForm(LatestProductContainerType::class, $object);

        if ($form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashbag()->set('success', 'Bien enregistré');
            $em->persist($object);
            $em->flush();
        }

        return $this->render(
            'DyweeProductCMSBundle:LatestProductContainer:edit.html.twig',
            ['form' => $form->createView()]
        );
    }
}
