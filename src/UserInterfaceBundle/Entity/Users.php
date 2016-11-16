<?php

namespace UserInterfaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="fk_users_cards_idx", columns={"cards_id"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=45, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=20, nullable=true)
     */
    private $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \UserInterfaceBundle\Entity\Cards
     *
     * @ORM\ManyToOne(targetEntity="UserInterfaceBundle\Entity\Cards")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cards_id", referencedColumnName="id")
     * })
     */
    private $cards;



    /**
     * Set name
     *
     * @param string $name
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Users
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Users
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
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
     * Set cards
     *
     * @param \UserInterfaceBundle\Entity\Cards $cards
     * @return Users
     */
    public function setCards(\UserInterfaceBundle\Entity\Cards $cards = null)
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * Get cards
     *
     * @return \UserInterfaceBundle\Entity\Cards 
     */
    public function getCards()
    {
        return $this->cards;
    }
    
    ///////// UPLOAD PHOTO
    
    private $file;
    
    public function getFile()
    {
        return $this->file;
    }
    
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }
    
    public function upload(UploadedFile $file = null)
    {
        if (null === $file) {
            return;
        }
        $name = $file->getClientOriginalName();
        $this->setPhoto($name);
        $file->move($this->getUploadRootDir(), $name);
    }
    
    public function getUploadDir()
    {
        return 'uploads/photos';
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
}
