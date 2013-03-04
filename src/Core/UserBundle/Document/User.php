<?php
namespace Core\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Role\StoreBundle\Document\Store", mappedBy="user")
     */
	private $role_store;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role_store
     *
     * @param \Role\StoreBundle\Document\Store $roleStore
     */
    public function setRoleStore(\Role\StoreBundle\Document\Store $roleStore)
    {
        $this->role_store = $roleStore;
        return $this;
    }

    /**
     * Get role_store
     *
     * @return \Role\StoreBundle\Document\Store $roleStore
     */
    public function getRoleStore()
    {
        return $this->role_store;
    }
}
