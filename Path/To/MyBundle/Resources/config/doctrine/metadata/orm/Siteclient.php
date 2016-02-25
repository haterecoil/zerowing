<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Siteclient
 *
 * @ORM\Table(name="Siteclient", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Siteclient
{
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=500, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="Validation", type="integer", nullable=false)
     */
    private $validation;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;


}
