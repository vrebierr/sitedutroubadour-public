<?php

namespace Sdt\ForumBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\ForumBundle\Entity\Post
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Post
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
     * @var string $message
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @var Topic $topic
     *
     * @ORM\ManyToOne(targetEntity="Sdt\ForumBundle\Entity\Topic", cascade={"persist", "remove"})
     */
    private $topic;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $author;

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
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->getTopic()->getForum()->setNumPosts($this->getTopic()->getForum()->getNumPosts() + 1);
        $this->getTopic()->setNumPosts($this->getTopic()->getNumPosts() + 1);

        if ($this->getTopic()->getFirstPost() != null)
            $this->getTopic()->setFirstPost($this);

        $this->getTopic()->setLastPost($this);
        $this->getTopic()->setPulledAt(new \Datetime);
        $this->getTopic()->getForum()->setLastPost($this);
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
     * Set message
     *
     * @param text $message
     * @return Post
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Post
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
     * @return Post
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
     * Set topic
     *
     * @param Sdt\ForumBundle\Entity\Topic $topic
     * @return Post
     */
    public function setTopic(\Sdt\ForumBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * Get topic
     *
     * @return Sdt\ForumBundle\Entity\Topic 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set author
     *
     * @param Application\Sonata\UserBundle\Entity\User $author
     * @return Post
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