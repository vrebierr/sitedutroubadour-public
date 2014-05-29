<?php

namespace Sdt\ForumBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\ForumBundle\Entity\Forum
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Forum
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
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Forum", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(unique=true)
     */
    private $slug;

    /**
     * @var integer $numTopics
     *
     * @ORM\Column(type="integer")
     */
    private $numTopics;

    /**
     * @var integer $numPosts
     *
     * @ORM\Column(type="integer")
     */
    private $numPosts;

    /**
     * @var Topic $lastTopic
     *
     * @ORM\OneToOne(targetEntity="Sdt\ForumBundle\Entity\Topic", cascade={"remove"})
     */
    private $lastTopic;

    /**
     * @var Post $lastPost
     *
     * @ORM\OneToOne(targetEntity="Sdt\ForumBundle\Entity\Post", cascade={"remove"})
     */
    private $lastPost;

    public function __construct()
    {
        $this->numTopics = 0;
        $this->numPosts = 0;
    }

    public function __toString()
    {
        return $this->name;
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

    public function setParent(Forum $parent = null)
    {
        $this->parent = $parent;    
    }

    public function getParent()
    {
        return $this->parent;   
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Forum
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
     * Set description
     *
     * @param string $description
     * @return Forum
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
     * Set slug
     *
     * @param string $slug
     * @return Forum
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
     * Set numTopics
     *
     * @param integer $numTopics
     * @return Forum
     */
    public function setNumTopics($numTopics)
    {
        $this->numTopics = $numTopics;
        return $this;
    }

    /**
     * Get numTopics
     *
     * @return integer 
     */
    public function getNumTopics()
    {
        return $this->numTopics;
    }

    /**
     * Set numPosts
     *
     * @param integer $numPosts
     * @return Forum
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
     * Set lastTopic
     *
     * @param Sdt\ForumBundle\Entity\Topic $lastTopic
     * @return Forum
     */
    public function setLastTopic(\Sdt\ForumBundle\Entity\Topic $lastTopic = null)
    {
        $this->lastTopic = $lastTopic;
        return $this;
    }

    /**
     * Get lastTopic
     *
     * @return Sdt\ForumBundle\Entity\Topic 
     */
    public function getLastTopic()
    {
        return $this->lastTopic;
    }

    /**
     * Set lastPost
     *
     * @param Sdt\ForumBundle\Entity\Post $lastPost
     * @return Forum
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
     * Set lft
     *
     * @param integer $lft
     * @return Forum
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Forum
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Forum
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Forum
     */
    public function setRoot($root)
    {
        $this->root = $root;
    
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Add children
     *
     * @param \Sdt\ForumBundle\Entity\Forum $children
     * @return Forum
     */
    public function addChildren(\Sdt\ForumBundle\Entity\Forum $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Sdt\ForumBundle\Entity\Forum $children
     */
    public function removeChildren(\Sdt\ForumBundle\Entity\Forum $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }
}