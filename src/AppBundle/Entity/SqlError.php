<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Exclude
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $value;

    /**
     * SqlError constructor.
     * @param string $value
     */
    public function __construct($value = '')
    {
        $this->value = $value;
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
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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

}
