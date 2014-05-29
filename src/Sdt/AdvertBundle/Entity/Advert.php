<?php

namespace Sdt\AdvertBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\AdvertBundle\Entity\Advert
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AdvertRepository")
 */
class Advert
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @Assert\NotBlank()
     * @Assert\MinLength(limit=4, message="Juste un peu trop court.")
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(unique=true)
     */
    private $slug;

    /**
     * @var string $message
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @var AdvertCategory $category
     *
     * @ORM\ManyToOne(targetEntity="Sdt\AdvertBundle\Entity\AdvertCategory")
     */
    private $category;

    /**
     * @var AdvertCategory $lookingFor
     *
     * @ORM\ManyToMany(targetEntity="Sdt\AdvertBundle\Entity\AdvertCategory")
     */
    private $lookingFor;

    /**
     * @var integer $ageMin
     *
     * @Assert\Range(min="13", max="60")
     * @ORM\Column(type="integer")
     */
    private $ageMin;

    /**
     * @var integer $ageMax
     *
     * @Assert\Range(min="13", max="60")
     * @ORM\Column(type="integer")
     */
    private $ageMax;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $author;

    /**
     * @var locale $locale
     *
     * @ORM\Column(type="string")
     */
    private $locale;

    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    public function __construct()
    {
        $this->lookingFor = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Advert
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set message
     *
     * @param text $message
     * @return Advert
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set ageMin
     *
     * @param integer $ageMin
     * @return Advert
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;
        return $this;
    }

    /**
     * Get ageMin
     *
     * @return integer 
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }

    /**
     * Set ageMax
     *
     * @param integer $ageMax
     * @return Advert
     */
    public function setAgeMax($ageMax)
    {
        $this->ageMax = $ageMax;
        return $this;
    }

    /**
     * Get ageMax
     *
     * @return integer 
     */
    public function getAgeMax()
    {
        return $this->ageMax;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return Advert
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Advert
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     * @return Advert
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set category
     *
     * @param Sdt\AdvertBundle\Entity\AdvertCategory $category
     * @return Advert
     */
    public function setCategory(\Sdt\AdvertBundle\Entity\AdvertCategory $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Sdt\AdvertBundle\Entity\AdvertCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add lookingFor
     *
     * @param Sdt\AdvertBundle\Entity\AdvertCategory $lookingFor
     * @return Advert
     */
    public function addLookingFor(\Sdt\AdvertBundle\Entity\AdvertCategory $lookingFor)
    {
        $this->lookingFor[] = $lookingFor;
        return $this;
    }

    /**
     * Remove lookingFor
     *
     * @param Sdt\AdvertBundle\Entity\AdvertCategory $lookingFor
     */
    public function removeLookingFor(\Sdt\AdvertBundle\Entity\AdvertCategory $lookingFor)
    {
        $this->lookingFor->removeElement($lookingFor);
    }

    /**
     * Get lookingFor
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLookingFor()
    {
        return $this->lookingFor;
    }

    /**
     * Set author
     *
     * @param Application\Sonata\UserBundle\Entity\User $author
     * @return Advert
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return Application\Sonata\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}