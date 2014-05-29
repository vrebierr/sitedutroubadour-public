<?php

namespace Sdt\ForumBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\ForumBundle\Entity\Topic
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Topic
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
     * @var string $subject
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="subject", type="string")
     */
    private $subject;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"subject"})
     * @ORM\Column(unique=true)
     */
    private $slug;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var string $message
     *
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var integer $numViews
     *
     * @ORM\Column(type="integer")
     */
    private $numViews;

    /**
     * @var integer $numPosts
     *
     * @ORM\Column(type="integer")
     */
    private $numPosts;

    /**
     * @var boolean $isClosed
     *
     * @ORM\Column(type="boolean")
     */
    private $isClosed;

    /**
     * @var boolean $isPinned
     *
     * @ORM\Column(type="boolean")
     */
    private $isPinned;

    /**
     * @var boolean $isBuried
     *
     * @ORM\Column(type="boolean")
     */
    private $isBuried;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(type="boolean")
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
     * @var datetime $pulledAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $pulledAt;

    /**
     * @var Forum $forum
     *
     * @ORM\ManyToOne(targetEntity="Sdt\ForumBundle\Entity\Forum")
     */
    private $forum;

    /**
     * @var Post $firstPost
     *
     * @ORM\ManyToOne(targetEntity="Sdt\ForumBundle\Entity\Post", cascade={"remove"})
     */
    private $firstPost;

    /**
     * @var Post $lastPost
     *
     * @ORM\ManyToOne(targetEntity="Sdt\ForumBundle\Entity\Post", cascade={"remove"})
     */
    private $lastPost;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $author;

    public function __construct()
    {
        $this->numViews = $this->numPosts = 0;
        $this->isClosed = $this->isPinned = $this->isBuried = false;
        $this->enabled = true;
    }

    public function __toString()
    {
        return $this->subject;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->getForum()->setNumTopics($this->getForum()->getNumTopics() + 1);
        $this->getForum()->setLastTopic($this);
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
     * Set subject
     *
     * @param string $subject
     * @return Topic
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Topic
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
     * @return Topic
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
     * Set numViews
     *
     * @param integer $numViews
     * @return Topic
     */
    public function setNumViews($numViews)
    {
        $this->numViews = $numViews;
        return $this;
    }

    /**
     * Get numViews
     *
     * @return integer 
     */
    public function getNumViews()
    {
        return $this->numViews;
    }

    /**
     * Set numPosts
     *
     * @param integer $numPosts
     * @return Topic
     */
    public function setNumPosts($numPosts)
    {
        $this->numPosts = $numPosts;
        return $this;
    }

    /**
     * Get numPosts
     *
     * @return integer 
     */
    public function getNumPosts()
    {
        return $this->numPosts;
    }

    /**
     * Set isClosed
     *
     * @param boolean $isClosed
     * @return Topic
     */
    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;
        return $this;
    }

    /**
     * Get isClosed
     *
     * @return boolean 
     */
    public function getIsClosed()
    {
        return $this->isClosed;
    }

    /**
     * Set isPinned
     *
     * @param boolean $isPinned
     * @return Topic
     */
    public function setIsPinned($isPinned)
    {
        $this->isPinned = $isPinned;
        return $this;
    }

    /**
     * Get isPinned
     *
     * @return boolean 
     */
    public function getIsPinned()
    {
        return $this->isPinned;
    }

    /**
     * Set isBuried
     *
     * @param boolean $isBuried
     * @return Topic
     */
    public function setIsBuried($isBuried)
    {
        $this->isBuried = $isBuried;
        return $this;
    }

    /**
     * Get isBuried
     *
     * @return boolean 
     */
    public function getIsBuried()
    {
        return $this->isBuried;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Topic
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
     * Set pulledAt
     *
     * @param datetime $pulledAt
     * @return Topic
     */
    public function setPulledAt($pulledAt)
    {
        $this->pulledAt = $pulledAt;
        return $this;
    }

    /**
     * Get pulledAt
     *
     * @return datetime 
     */
    public function getPulledAt()
    {
        return $this->pulledAt;
    }

    /**
     * Set forum
     *
     * @param Sdt\ForumBundle\Entity\Forum $forum
     * @return Topic
     */
    public function setForum(\Sdt\ForumBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * Get forum
     *
     * @return Sdt\ForumBundle\Entity\Forum 
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set firstPost
     *
     * @param Sdt\ForumBundle\Entity\Post $firstPost
     * @return Topic
     */
    public function setFirstPost(\Sdt\ForumBundle\Entity\Post $firstPost = null)
    {
        $this->firstPost = $firstPost;
        return $this;
    }

    /**
     * Get firstPost
     *
     * @return Sdt\ForumBundle\Entity\Post 
     */
    public function getFirstPost()
    {
        return $this->firstPost;
    }

    /**
     * Set lastPost
     *
     * @param Sdt\ForumBundle\Entity\Post $lastPost
     * @return Topic
     */
    public function setLastPost(\Sdt\ForumBundle\Entity\Post $lastPost = null)
    {
        $this->lastPost = $lastPost;
        return $this;
    }

    /**
     * Get lastPost
     *
     * @return Sdt\ForumBundle\Entity\Post 
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }

    /**
     * Set author
     *
     * @param Application\Sonata\UserBundle\Entity\User $author
     * @return Topic
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
     * Set description
     *
     * @param string $description
     * @return Topic
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Topic
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
}