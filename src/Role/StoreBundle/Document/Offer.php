<?php

namespace Role\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\Document
 */
class Offer
{
    /**
     *
     * @MongoDB\Id
     */
    private $id;

    /**
     * @var string
     *
     * @MongoDB\Field(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @MongoDB\Field(name="description", type="string")
     */
    private $description;

    /**
     *
     * @MongoDB\Field(name="stock_limit", type="int")
     */
    private $stockLimit;

    /**
     * @var \DateTime
     *
     * @MongoDB\Field(name="time_limit", type="date")
     */
    private $timeLimit;

    /**
     * @MongoDB\Field(name="price", type="string")
     */
    private $price;

    /**
     * @var string
     *
     * @MongoDB\Field(name="path", type="string")
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @MongoDB\Field(name="created_at", type="date")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @MongoDB\Field(name="updated_at", type="date")
     */
    private $updatedAt;

    /** @MongoDB\ReferenceOne(targetDocument="Store", inversedBy="offers") */
    private $store;

    /*
     * @Assert\File(maxSize="6000000")
    */
    private $file;

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/offers';
    }

    public function upload(){
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }
        // set the path property to the filename where you've saved the file
        $filename = sha1(uniqid(mt_rand(), true));
        $this->path = $filename.'.'.$this->file->guessExtension();
        
        $this->file->move(
            $this->getUploadRootDir(),
            $this->path
        );
        // clean up the file property as you won't need it anymore
        $this->file = null;
    }


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
    public function setPrice($pricing)
    {
        $this->price = $pricing;
    
        return $this;
    }

    /**
     * Get pricing
     *
     * @return array 
     */
    public function getPrice()
    {
        return $this->price;
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

    public function setFile($file){
        $this->file = $file;
        return $this;
    }

    public function getFile(){
        return $this->file;
    }


    /**
     * Set store
     *
     * @param Role\StoreBundle\Document\Store $store
     * @return \Offer
     */
    public function setStore(\Role\StoreBundle\Document\Store $store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * Get store
     *
     * @return Role\StoreBundle\Document\Store $store
     */
    public function getStore()
    {
        return $this->store;
    }
}
