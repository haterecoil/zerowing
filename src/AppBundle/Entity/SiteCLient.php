<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="site_c_lient")
 */
class SiteCLient
{
    /**
     * @ORM\ManyToOne(targetEntity="user", inversedBy="urls")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="validation", type="integer")
     */
    private $validation;


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
     * Set url
     *
     * @param string $url
     * @return SiteCLient
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set validation
     *
     * @param integer $validation
     * @return SiteCLient
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return integer 
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\user $user
     * @return SiteCLient
     */
    public function setUser(\AppBundle\Entity\user $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\user 
     */
    public function getUser()
    {
        return $this->user;
    }
}
