<?php

namespace Role\StoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Store
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;


    /** @MongoDB\ReferenceMany(targetDocument="Offer", mappedBy="store") */
    private $offers;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Core\UserBundle\Document\User", inversedBy="role_store")
     */
    private $user;


    /**
     * @MongoDB\String(name="public_name", type="string")
     */
    private $publicName;

    /**
     * @var string
     *
     * @MongoDB\Field(name="legal_name", type="string")
     */
    private $legalName;

    /**
     * @var string
     *
     * @MongoDB\Field(name="slug_name", type="string")
     */
    private $slugName;

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

    public function __construct(){
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
     * Set publicName
     *
     * @param string $publicName
     * @return Store
     */
    public function setPublicName($publicName)
    {
        $this->publicName = $publicName;
    
        return $this;
    }

    /**
     * Get publicName
     *
     * @return string 
     */
    public function getPublicName()
    {
        return $this->publicName;
    }

    /**
     * Set legalName
     *
     * @param string $legalName
     * @return Store
     */
    public function setLegalName($legalName)
    {
        $this->legalName = $legalName;
    
        return $this;
    }

    /**
     * Get legalName
     *
     * @return string 
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * Set slugName
     *
     * @param string $slugName
     * @return Store
     */
    public function setSlugName($slugName)
    {
        $this->slugName = $slugName;
    
        return $this;
    }

    /**
     * Get slugName
     *
     * @return string 
     */
    public function getSlugName()
    {
        return $this->slugName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Store
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
     * @return Store
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

    /**
     * Set user
     *
     * @param \Core\UserBundle\Entity\User $user
     * @return Store
     */
    public function setUser(\Core\UserBundle\Document\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Core\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add offers
     *
     * @param Role\StoreBundle\Document\Offer $offers
     */
    public function addOffer(\Role\StoreBundle\Document\Offer $offers)
    {
        $this->offers[] = $offers;
    }

    /**
    * Remove offers
    *
    * @param <variableType$offers
    */
    public function removeOffer(\Role\StoreBundle\Document\Offer $offers)
    {
        $this->offers->removeElement($offers);
    }

    /**
     * Get offers
     *
     * @return Doctrine\Common\Collections\Collection $offers
     */
    public function getOffers()
    {
        return $this->offers;
    }
}
