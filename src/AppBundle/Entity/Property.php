<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Property
 *
 * @ORM\Table(name="property", indexes={@ORM\Index(name="account_id", columns={"account_id"})})
 * @ORM\Entity
 */
class Property
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Exclude()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="base_url", type="string", length=100, nullable=false, unique=true)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Url
     */
    private $baseUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="validation_url", type="string", length=100, nullable=false)
     */
    private $validationUrl;

    /**
     * @var \AppBundle\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * })
     */
    private $account;

    /**
     * Property constructor.
     * @param string $baseUrl
     * @param string $validationUrl
     * @param Account $account
     */
    public function __construct($baseUrl = '')
    {
        $this->baseUrl = $baseUrl;
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
     * Set baseUrl
     *
     * @param string $baseUrl
     * @return Property
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Get baseUrl
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set validationUrl
     *
     * @param string $validationUrl
     * @return Property
     */
    public function setValidationUrl($validationUrl)
    {
        $this->validationUrl = $validationUrl;

        return $this;
    }

    /**
     * Get validationUrl
     *
     * @return string
     */
    public function getValidationUrl()
    {
        return $this->validationUrl;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\Account $account
     * @return Property
     */
    public function setAccount(\AppBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
