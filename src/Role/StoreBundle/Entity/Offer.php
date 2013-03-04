<?php

namespace Role\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Offer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="pricing", type="array")
     */
    private $pricing;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_limit", type="integer")
     */
    private $stockLimit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_limit", type="datetime",nullable=true)
     */
    private $timeLimit;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Offer
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Offer
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pricing
     *
     * @param array $pricing
     * @return Offer
     */
    public function setPricing($pricing)
    {
        $this->pricing = $pricing;
    
        return $this;
    }

    /**
     * Get pricing
     *
     * @return array 
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * Set stockLimit
     *
     * @param integer $stockLimit
     * @return Offer
     */
    public function setStockLimit($stockLimit)
    {
        $this->stockLimit = $stockLimit;
    
        return $this;
    }

    /**
     * Get stockLimit
     *
     * @return integer 
     */
    public function getStockLimit()
    {
        return $this->stockLimit;
    }

    /**
     * Set timeLimit
     *
     * @param \DateTime $timeLimit
     * @return Offer
     */
    public function setTimeLimit($timeLimit)
    {
        $this->timeLimit = $timeLimit;
    
        return $this;
    }

    /**
     * Get timeLimit
     *
     * @return \DateTime 
     */
    public function getTimeLimit()
    {
        return $this->timeLimit;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Offer
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Offer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Offer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
