<?php

namespace Dywee\ProductCMSBundle\Controller;

use Dywee\CoreBundle\Controller\ParentController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductGalleryController extends ParentController
{
    /**
     * @param Request $request
     * @param null $parameters
     * @Route(path="/admin/productCMS/gallery/add", name="product_gallery_add")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, $parameters = null)
    {
        return parent::addAction($request, $parameters);
    }

    /**
     * @param $id
     * @param Request $request
     * @param null $parameters
     * @Route(path="/admin/productCMS/gallery/{id}/edit", name="product_gallery_edit")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Request $request, $parameters = null)
    {
        return parent::updateAction($id, $request, $parameters);
    }

    /**
     * @param $id
     * @param Request $request
     * @param null $parameters
     * @Route(path="/admin/productCMS/gallery/{id}/delete", name="product_gallery_delete")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id, Request $request, $parameters = null)
    {
        return parent::deleteAction($id, $request, $parameters);
    }

    /**
     * @param null $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/admin/productCMS/gallery", name="product_gallery_table")
     */
    public function tableAction($parameters = null)
    {
        return parent::tableAction($parameters);
    }

    /**
     * @param $id
     * @param null $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/admin/productCMS/gallery/{id}", name="product_gallery_view")
     */
    public function viewAction($id, $parameters = null)
    {
        return parent::viewAction($id, $parameters);
    }
}
