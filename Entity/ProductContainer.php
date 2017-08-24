<?php

namespace Dywee\ProductCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProductContainer
 *
 * @ORM\Entity(repositoryClass="Dywee\ProductCMSBundle\Repository\ProductContainerRepository")
 */
class ProductContainer
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
     * @var array
     *
     * @ORM\Column(name="enabledTypes", type="array", nullable=true)
     */
    private $enabledTypes = ['all'];

    /**
     * @var int
     *
     * @ORM\Column(name="max", type="smallint")
     */
    private $max = 6;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private $numberPerRow = 3;

    /**
     * @ORM\OneToMany(targetEntity="ProductElement", mappedBy="container", cascade={"persist"})
     */
    private $elements;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

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
        $this->elements = new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getEnabledTypes() : array
    {
        return $this->enabledTypes;
    }

    /**
     * @param array $enabledTypes
     *
     * @return ProductContainer
     */
    public function setEnabledTypes(array $enabledTypes) : ProductContainer
    {
        $this->enabledTypes = $enabledTypes;

        return $this;
    }

    /**
     * @return int
     */
    public function getMax() : int
    {
        return $this->max;
    }

    /**
     * @param int $max
     *
     * @return ProductContainer
     */
    public function setMax(int $max) : ProductContainer
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberPerRow() : int
    {
        return $this->numberPerRow;
    }

    /**
     * @param int $numberPerRow
     *
     * @return ProductContainer
     */
    public function setNumberPerRow($numberPerRow)
    {
        $this->numberPerRow = $numberPerRow;

        return $this;
    }

    /**
     * Add element
     *
     * @param ProductElement $element
     *
     * @return ProductContainer
     */
    public function addElement(ProductElement $element)
    {
        $this->elements[] = $element;
        $element->setContainer($this);

        return $this;
    }

    /**
     * Remove element
     *
     * @param ProductElement $element
     */
    public function removeElement(ProductElement $element)
    {
        $this->elements->removeElement($element);
    }

    /**
     * Get elements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getElements()
    {
        return $this->elements;
    }


    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return ProductContainer
     */
    public function setName(string $name) : ProductContainer
    {
        $this->name = $name;

        return $this;
    }
}
