<?php

namespace Sdt\TutorialBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\TutorialBundle\Entity\Tutorial
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tutorial
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
     * @var Bool $requested
     *
     * @ORM\Column(type="boolean")
     */
    private $requested;

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
     * @var Media $media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    private $media;

    /**
     * @var string $description
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string $content
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string")
     */
    private $status;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $author;

    /**
     * @var TutorialCategory $category
     *
     * @ORM\ManyToOne(targetEntity="Sdt\TutorialBundle\Entity\TutorialCategory")
     */
    private $category;

    /**
     * @var integer $numComments
     *
     * @ORM\Column(type="integer")
     */
    private $numComments;

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

    public function __construct()
    {
        $this->numComments = 0;
        $this->requested = 0;
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
     * Set title
     *
     * @param string $title
     * @return Tutorial
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
     * @return Tutorial
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
     * Set content
     *
     * @param text $content
     * @return Tutorial
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Tutorial
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set numComments
     *
     * @param integer $numComments
     * @return Tutorial
     */
    public function setNumComments($numComments)
    {
        $this->numComments = $numComments;
        return $this;
    }

    /**
     * Get numComments
     *
     * @return integer 
     */
    public function getNumComments()
    {
        return $this->numComments;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Tutorial
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
     * @return Tutorial
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
     * Set media
     *
     * @param Application\Sonata\MediaBundle\Entity\Media $media
     * @return Tutorial
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;
        return $this;
    }

    /**
     * Get media
     *
     * @return Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set author
     *
     * @param Application\Sonata\UserBundle\Entity\User $author
     * @return Tutorial
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

    /**
     * Set category
     *
     * @param Sdt\TutorialBundle\Entity\TutorialCategory $category
     * @return Tutorial
     */
    public function setCategory(\Sdt\TutorialBundle\Entity\TutorialCategory $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Sdt\TutorialBundle\Entity\TutorialCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set requested
     *
     * @param boolean $requested
     * @return Tutorial
     */
    public function setRequested($requested)
    {
        $this->requested = $requested;
        return $this;
    }

    /**
     * Get requested
     *
     * @return boolean 
     */
    public function getRequested()
    {
        return $this->requested;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Tutorial
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
