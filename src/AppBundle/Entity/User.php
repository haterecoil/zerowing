<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\SiteCLient;

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
    /**
     * @ORM\OneToMany(targetEntity="SiteCLient", mappedBy="User")
     */
    protected $urls;

    public function __construct()
    {
        parent::__construct();
        $this->urls = new ArrayCollection();
        // your own logic
    }







    /**
     * Add urls
     *
     * @param \AppBundle\Entity\siteclient $urls
     * @return User
     */
    public function addUrl(\AppBundle\Entity\siteclient $urls)
    {
        $this->urls[] = $urls;

        return $this;
    }

    /**
     * Remove urls
     *
     * @param \AppBundle\Entity\siteclient $urls
     */
    public function removeUrl(\AppBundle\Entity\siteclient $urls)
    {
        $this->urls->removeElement($urls);
    }

    /**
     * Get urls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUrls()
    {
        return $this->urls;
    }
}
