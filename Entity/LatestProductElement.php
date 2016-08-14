<?php

namespace Dywee\ProductCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LatestProductElement
 *
 * @ORM\Table(name="latest_product_element")
 * @ORM\Entity(repositoryClass="Dywee\ProductCMSBundle\Repository\LatestProductElementRepository")
 */
class LatestProductElement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="displayOrder", type="smallint", nullable=true)
     */
    private $displayOrder = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Dywee\ProductBundle\Entity\BaseProduct")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="LatestProductContainer", inversedBy="elements")
     */
    private $container;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set displayOrder
     *
     * @param integer $displayOrder
     *
     * @return LatestProductElement
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * Get displayOrder
     *
     * @return int
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * Set product
     *
     * @param \Dywee\ProductBundle\Entity\BaseProduct $product
     *
     * @return LatestProductElement
     */
    public function setProduct(\Dywee\ProductBundle\Entity\BaseProduct $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Dywee\ProductBundle\Entity\BaseProduct
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set container
     *
     * @param \Dywee\ProductCMSBundle\Entity\LatestProductContainer $container
     *
     * @return LatestProductElement
     */
    public function setContainer(\Dywee\ProductCMSBundle\Entity\LatestProductContainer $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get container
     *
     * @return \Dywee\ProductCMSBundle\Entity\LatestProductContainer
     */
    public function getContainer()
    {
        return $this->container;
    }
}
