<?php

namespace Sdt\SessionBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Teacher
{
    public function __construct()
    {
        $this->setRating(0);
        $this->setRates(0);
        $this->setEnabled(true);
        $this->setLocked(false);
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User $user
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var string $advert
     *
     * @ORM\Column(type="text")
     */
    private $advert;

    /**
     * @var integer $price
     *
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @var integer $rating
     *
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @var integer $rates
     *
     * @ORM\Column(type="integer")
     */
    private $rates;

    /**
     * @var Bool $enabled
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var Bool $locked
     *
     * @ORM\Column(type="boolean")
     */
    private $locked;

    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updateAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var string $firstname
     *
     * @ORM\Column(type="string")
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @ORM\Column(type="string")
     */
    private $lastname;

    /**
     * @var string $address1
     *
     * @ORM\Column(type="string")
     */
    private $address1;

    /**
     * @var string $address2
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $address2;

    /**
     * @var string $zipcode
     *
     * @ORM\Column(type="integer")
     */
    private $zipcode;

    /**
     * @var string $city
     *
     * @ORM\Column(type="string")
     */
    private $city;

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
     * Set advert
     *
     * @param string $advert
     * @return Teacher
     */
    public function setAdvert($advert)
    {
        $this->advert = $advert;
    
        return $this;
    }

    /**
     * Get advert
     *
     * @return string 
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Teacher
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Teacher
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    
        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rates
     *
     * @param integer $rates
     * @return Teacher
     */
    public function setRates($rates)
    {
        $this->rates = $rates;
    
        return $this;
    }

    /**
     * Get rates
     *
     * @return integer 
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Teacher
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     * @return Teacher
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
    
        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Teacher
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Teacher
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Teacher
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Teacher
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return Teacher
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    
        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Teacher
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    
        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set zipcode
     *
     * @param integer $zipcode
     * @return Teacher
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return integer 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Teacher
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Teacher
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}