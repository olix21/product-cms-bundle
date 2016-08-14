<?php

namespace Dywee\ProductCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductGallery
 *
 * @ORM\Table(name="product_gallery")
 * @ORM\Entity(repositoryClass="Dywee\ProductCMSBundle\Repository\ProductGalleryRepository")
 */
class ProductGallery
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Dywee\ProductBundle\Entity\BaseProduct")
     */
    private $products;


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
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProductGallery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add product
     *
     * @param \Dywee\ProductBundle\Entity\BaseProduct $product
     *
     * @return ProductGallery
     */
    public function addProduct(\Dywee\ProductBundle\Entity\BaseProduct $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Dywee\ProductBundle\Entity\BaseProduct $product
     */
    public function removeProduct(\Dywee\ProductBundle\Entity\BaseProduct $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
