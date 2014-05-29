<?php

namespace Sdt\TutorialBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\TutorialBundle\Entity\TutorialComment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TutorialComment
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
     * @var Tutorial $tutorial
     *
     * @ORM\ManyToOne(targetEntity="Sdt\TutorialBundle\Entity\Tutorial")
     */
    private $tutorial;

    /**
     * @var string $message
     *
     * @ORM\Column(type="text")
     */
    private $message;

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
     * @var datetime $updateAt
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
}