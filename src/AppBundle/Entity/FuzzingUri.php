<?php

namespace AppBundle\Entity;

use AppBundle\Utils\Target\FuzzTarget;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Exclude
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     */
    private $uri;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="http_method", type="string", length=7)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Choice(choices = {"GET", "POST", "PUT", "DELETE"})
     */
    private $http_method;

    /**
     * @var array
     *
     * @ORM\Column(name="http_target", type="array")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $http_target;

    /**
     * @var string
     * @ORM\Column(name="csrf", type="string", length=64, nullable=true)
     */
    private $csrf;

    /**
     * @var string
     * @ORM\Column(name="match_success", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $match_success;

    /**
     * FuzzingUri constructor.
     * @param string $uri
     * @param string $type
     * @param string $http_method
     * @param array $http_target
     * @param string $csrf
     * @param string $match_success
     */
    public function __construct($uri = '', $type = '', $http_method = '', $http_target = array(), $match_success = '', $csrf = '' )
    {
        $this->uri = $uri;
        $this->type = $type;
        $this->http_method = $http_method;
        $this->http_target = $http_target;
        $this->csrf = $csrf;
        $this->match_success = $match_success;
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
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * Get csrf hidden input's name
     *
     * @return string
     */
    public function getCsrf()
    {
        return $this->csrf;
    }

    /**
     * Set csrf
     *
     * @param string $csrf
     * @return FuzzingUri
     */
    public function setCsrf($csrf)
    {
        $this->csrf = $csrf;

        return $this;
    }

    public function getFuzzTarget()
    {
        $http_params = array();
        foreach ($this->getHttpTarget() as $one_http_target) {
            $one_http_target_exploded = explode(':', $one_http_target);
            if (!isset($one_http_target_exploded[1])) {
                $one_http_target_exploded[1] = null;
            }
            $http_params[$one_http_target_exploded[0]] = $one_http_target_exploded[1];
        }

        return new FuzzTarget(
            $this->getHttpMethod(),
            $this->getUri(),
            $http_params
        );
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
     * Get http_method
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->http_method;
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
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
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
     * Set match_success
     *
     * @param string $matchSuccess
     * @return FuzzingUri
     */
    public function setMatchSuccess($matchSuccess)
    {
        $this->match_success = $matchSuccess;

        return $this;
    }

    /**
     * Get match_success
     *
     * @return string 
     */
    public function getMatchSuccess()
    {
        return $this->match_success;
    }
}
