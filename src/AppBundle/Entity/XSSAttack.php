<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * XSSAttack
 *
 * @ORM\Table(name="x_s_s_attack")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\XSSAttackRepository")
 */
class XSSAttack
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
     * @ORM\Column(name="message", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $message;

    /**
     * XSSAttack constructor.
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
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
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return XSSAttack
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
