<?php

namespace Dywee\ProductCMSBundle\Controller;

use App\Entity\GlobalMusicSheet;
use Dywee\ProductCMSBundle\Entity\ProductContainer;
use Dywee\ProductCMSBundle\Form\ProductContainerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductContainerController extends AbstractController
{
    public function installAction()
    {
        $latestProductContainer = new ProductContainer();
        $em = $this->getDoctrine()->getManager();
        $em->persist($latestProductContainer);
        $em->flush();
    }

    //                    'route' => $this->router->generate('')

    /**
     * @Route(name="product_container_admin_list", path="admin/productCMS/containers")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminListAction()
    {
        $productContainers = $this->getDoctrine()->getRepository(ProductContainer::class)->findAll();

        return $this->render(
            'DyweeProductCMSBundle:ProductContainer:list.html.twig',
            [
            'productContainers' => $productContainers,
            ]
        );
    }

    /**
     * @Route(path="/admin/productCMS/latestProducts", name="product_cms_latest_products")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @deprecated
     */
    public function deprecatedUpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DyweeProductCMSBundle:ProductContainer');
        $object = $repository->findOneBy(['id' => 1]);

        if (!$object) {
            $object = new ProductContainer();
        }

        $form = $this->createForm(ProductContainerType::class, $object);

        if ($form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashbag()->set('success', 'Bien enregistré');
            $em->persist($object);
            $em->flush();
        }

        return $this->render('DyweeProductCMSBundle:ProductContainer:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(name="product_container_admin_add", path="admin/productCMS/container/add")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $container = new ProductContainer();

        $form = $this->createForm(ProductContainerType::class, $container);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $request->getSession()->getFlashbag()->set('success', 'Bien enregistré');
            $em->persist($container);
            $em->flush();

            return $this->redirectToRoute('product_container_admin_list');
        }

        return $this->render('DyweeProductCMSBundle:ProductContainer:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(name="product_container_admin_update", path="admin/productCMS/container/{id}/update")
     *
     * @param ProductContainer $container
     * @param Request          $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(ProductContainer $container, Request $request)
    {
        $form = $this->createForm(ProductContainerType::class, $container);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $request->getSession()->getFlashbag()->set('success', 'Bien enregistré');
            $em->persist($container);
            $em->flush();

            return $this->redirectToRoute('product_container_admin_list');
        }

        return $this->render('DyweeProductCMSBundle:ProductContainer:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(name="product_container_admin_view", path="admin/productCMS/container/{id}")
     *
     * @param ProductContainer $container
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(ProductContainer $container)
    {
        return $this->render(
            'DyweeProductCMSBundle:ProductContainer:view.html.twig',
            ['productContainer' => $container]
        );
    }

    /**
     * @Route(name="product_container_render", path="product_cms/container/{id}")
     *
     * @param ProductContainer $container
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderAction(ProductContainer $container)
    {
        $repo = null;
        foreach ($container->getElements() as $element) {
            if (get_class($element->getProduct()) === 'App\Entity\GlobalMusicSheet') {
                if (!$repo) {
                    $repo = $this->getDoctrine()->getRepository('App\Entity\GlobalMusicSheet');
                }
                $musicSheet = $repo->find($element->getProduct()->getId());
            }
        }

        return $this->render(
            'DyweeProductCMSBundle:ProductContainer:render.html.twig',
            ['productContainer' => $container]
        );
    }

    /**
     * @Route(name="product_container_admin_delete", path="admin/productCMS/container/{id}/delete")
     *
     * @param ProductContainer $container
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(ProductContainer $container)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($container);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'item.removed');

        return $this->redirectToRoute('product_container_admin_list');
    }
}
