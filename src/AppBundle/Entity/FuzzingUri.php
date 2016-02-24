<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuzzingUri
 *
 * @ORM\Table(name="fuzzing_uri")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FuzzingUriRepository")
 */
class FuzzingUri
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
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255)
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="http_method", type="string", length=7)
     */
    private $http_method;

    /**
     * @var array
     *
     * @ORM\Column(name="http_target", type="array")
     */
    private $http_target;


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
     * Set uri
     *
     * @param string $uri
     * @return FuzzingUri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string 
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return FuzzingUri
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set http_target
     *
     * @param array $httpTarget
     * @return FuzzingUri
     */
    public function setHttpTarget($httpTarget)
    {
        $this->http_target = $httpTarget;

        return $this;
    }

    /**
     * Get http_target
     *
     * @return array 
     */
    public function getHttpTarget()
    {
        return $this->http_target;
    }

    /**
     * Set http_method
     *
     * @param string $httpMethod
     * @return FuzzingUri
     */
    public function setHttpMethod($httpMethod)
    {
        $this->http_method = $httpMethod;

        return $this;
    }

    /**
     * Get http_method
     *
     * @return string 
     */
    public function getHttpMethod()
    {
        return $this->http_method;
    }
}
