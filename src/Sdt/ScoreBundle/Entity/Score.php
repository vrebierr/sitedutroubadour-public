<?php

namespace Sdt\ScoreBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\ScoreBundle\Entity\Score
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ScoreRepository")
 */
class Score
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
     * @var string $artist
     *
     * @ORM\Column(name="artist", type="string")
     */
    private $artist;

    /**
     * @var string $song
     *
     * @ORM\Column(name="song", type="string")
     */
    private $song;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"artist", "song"})
     * @ORM\Column(unique=true)
     */
    private $slug;

    /**
     * @var Media $media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     */
    private $media;

    /**
     * @var User $uploader
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $uploader;

    /**
     * @var ScoreCategory $category
     *
     * @ORM\ManyToOne(targetEntity="Sdt\ScoreBundle\Entity\ScoreCategory")
     */
    private $category;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

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

    public function __construct()
    {
        $this->enabled = false;
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
     * Set artist
     *
     * @param string $artist
     * @return Score
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * Get artist
     *
     * @return string 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set song
     *
     * @param string $song
     * @return Score
     */
    public function setSong($song)
    {
        $this->song = $song;
        return $this;
    }

    /**
     * Get song
     *
     * @return string 
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Score
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
     * Set enabled
     *
     * @param string $enabled
     * @return Score
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return string 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Score
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
     * @return Score
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
     * @return Score
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
     * Set uploader
     *
     * @param Application\Sonata\UserBundle\Entity\User $uploader
     * @return Score
     */
    public function setUploader(\Application\Sonata\UserBundle\Entity\User $uploader = null)
    {
        $this->uploader = $uploader;
        return $this;
    }

    /**
     * Get uploader
     *
     * @return Application\Sonata\UserBundle\Entity\User 
     */
    public function getUploader()
    {
        return $this->uploader;
    }

    /**
     * Set category
     *
     * @param Sdt\ScoreBundle\Entity\ScoreCategory $category
     * @return Score
     */
    public function setCategory(\Sdt\ScoreBundle\Entity\ScoreCategory $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Sdt\ScoreBundle\Entity\ScoreCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }
}