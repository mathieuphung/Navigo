<?php

namespace UserInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cards
 *
 * @ORM\Table(name="cards")
 * @ORM\Entity
 */
class Cards
{
    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=13, nullable=false)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valid_untill", type="datetime", nullable=false)
     */
    private $validUntill;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set number
     *
     * @param string $number
     * @return Cards
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set validUntill
     *
     * @param \DateTime $validUntill
     * @return Cards
     */
    public function setValidUntill($validUntill)
    {
        $this->validUntill = $validUntill;

        return $this;
    }

    /**
     * Get validUntill
     *
     * @return \DateTime 
     */
    public function getValidUntill()
    {
        return $this->validUntill;
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
}
