<?php

namespace Core\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /** @ORM\OneToOne(targetEntity="Role\StoreBundle\Entity\Store")
     *  @ORM\JoinColumn(name="store_id", referencedColumnName="id")
     */
    protected $store;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;


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
     * Set path
     *
     * @param string $path
     * @return User
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
     * Set store
     *
     * @param \Role\StoreBundle\Entity\Store $store
     * @return User
     */
    public function setStore(\Role\StoreBundle\Entity\Store $store = null)
    {
        $this->store = $store;
    
        return $this;
    }

    /**
     * Get store
     *
     * @return \Role\StoreBundle\Entity\Store 
     */
    public function getStore()
    {
        return $this->store;
    }
}