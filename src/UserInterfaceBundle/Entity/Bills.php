<?php

namespace UserInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bills
 *
 * @ORM\Table(name="bills", indexes={@ORM\Index(name="fk_bills_users1_idx", columns={"users_id"})})
 * @ORM\Entity
 */
class Bills
{
    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \UserInterfaceBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="UserInterfaceBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     * })
     */
    private $users;



    public function __construct()
    {
        $this->date = new \DateTime();
    }
    
    /**
     * Set total
     *
     * @param float $total
     * @return Bills
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Bills
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
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
     * Set users
     *
     * @param \UserInterfaceBundle\Entity\Users $users
     * @return Bills
     */
    public function setUsers(\UserInterfaceBundle\Entity\Users $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \UserInterfaceBundle\Entity\Users 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
