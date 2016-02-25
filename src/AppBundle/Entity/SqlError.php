<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SqlError
 *
 * @ORM\Table(name="sql_error")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SqlErrorRepository")
 */
class SqlError
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

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
     * Set value
     *
     * @param string $value
     * @return SqlError
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set errorResponse
     *
     * @param string $errorResponse
     * @return SqlError
     */
    public function setErrorResponse($errorResponse)
    {
        $this->errorResponse = $errorResponse;

        return $this;
    }

    /**
     * Get errorResponse
     *
     * @return string 
     */
    public function getErrorResponse()
    {
        return $this->errorResponse;
    }

    /**
     * Set newRequest
     *
     * @param integer $newRequest
     * @return SqlError
     */
    public function setNewRequest($newRequest)
    {
        $this->newRequest = $newRequest;

        return $this;
    }

    /**
     * Get newRequest
     *
     * @return integer 
     */
    public function getNewRequest()
    {
        return $this->newRequest;
    }
}
