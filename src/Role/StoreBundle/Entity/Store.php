<?php

namespace Role\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Store
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Store
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /** @ORM\OneToOne(targetEntity="Core\UserBundle\Entity\User") */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="public_name", type="string", length=255)
     */
    private $publicName;

    /**
     * @var string
     *
     * @ORM\Column(name="legal_name", type="string", length=255)
     */
    private $legalName;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_name", type="string", length=255)
     */
    private $slugName;

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
    public function setUser(\Core\UserBundle\Entity\User $user = null)
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
}