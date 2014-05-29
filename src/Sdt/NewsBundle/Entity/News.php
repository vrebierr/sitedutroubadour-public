<?php

namespace Sdt\NewsBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\NewsBundle\Entity\News
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class News
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
     * @var News $parent
     *
     * @ORM\ManyToOne(targetEntity="Sdt\NewsBundle\Entity\News")
     */
    private $parent;

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
     * @var NewsCategory $category
     *
     * @ORM\ManyToOne(targetEntity="Sdt\NewsBundle\Entity\NewsCategory")
     */
    private $category;

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

    public function __toString()
    {
        return $this->title;
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
     * @return News
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
     * @return News
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
     * @return News
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return News
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
     * Set author
     *
     * @param Application\Sonata\UserBundle\Entity\User $author
     * @return News
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
     * Set updatedAt
     *
     * @param datetime $updatedAt
     * @return News
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
     * @param Sdt\NewsBundle\Entity\NewsCategory $category
     * @return News
     */
    public function setCategory(\Sdt\NewsBundle\Entity\NewsCategory $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Sdt\NewsBundle\Entity\NewsCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set numComments
     *
     * @param integer $numComments
     * @return News
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
     * Set status
     *
     * @param string $status
     * @return News
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
     * Set parent
     *
     * @param Sdt\NewsBundle\Entity\News $parent
     * @return News
     */
    public function setParent(\Sdt\NewsBundle\Entity\News $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Sdt\NewsBundle\Entity\News 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set media
     *
     * @param Application\Sonata\MediaBundle\Entity\Media $media
     * @return News
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
}