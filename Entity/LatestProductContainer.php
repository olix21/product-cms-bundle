<?php

namespace Dywee\ProductCMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LatestProductContainer
 *
 * @ORM\Table(name="homepage_latest_product_container")
 * @ORM\Entity(repositoryClass="Dywee\ProductCMSBundle\Repository\LatestProductContainerRepository")
 */
class LatestProductContainer
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
    private $enabledTypes = array('all');

    /**
     * @var int
     *
     * @ORM\Column(name="max", type="smallint")
     */
    private $max = 6;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numberPerRow = 3;

    /**
     * @ORM\OneToMany(targetEntity="LatestProductElement", mappedBy="container", cascade={"persist"})
     */
    private $elements;

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
     * Set enabledTypes
     *
     * @param array $enabledTypes
     *
     * @return LatestProductContainer
     */
    public function setEnabledTypes($enabledTypes)
    {
        $this->enabledTypes = $enabledTypes;

        return $this;
    }

    /**
     * Get enabledTypes
     *
     * @return array
     */
    public function getEnabledTypes()
    {
        return $this->enabledTypes;
    }

    /**
     * Set max
     *
     * @param integer $max
     *
     * @return LatestProductContainer
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }

    /**
     * Add element
     *
     * @param LatestProductElement $element
     *
     * @return LatestProductContainer
     */
    public function addElement(LatestProductElement $element)
    {
        $this->elements[] = $element;
        $element->setContainer($this);

        return $this;
    }

    /**
     * Remove element
     *
     * @param LatestProductElement $element
     */
    public function removeElement(LatestProductElement $element)
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
     * Set numberPerRow
     *
     * @param integer $numberPerRow
     *
     * @return LatestProductContainer
     */
    public function setNumberPerRow($numberPerRow)
    {
        $this->numberPerRow = $numberPerRow;

        return $this;
    }

    /**
     * Get numberPerRow
     *
     * @return integer
     */
    public function getNumberPerRow()
    {
        return $this->numberPerRow;
    }
}
