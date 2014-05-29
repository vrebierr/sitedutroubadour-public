<?php

namespace Sdt\CoreBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sdt\CoreBundle\Entity\Contact
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Contact
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
     * @ORM\Column(type="string")
     */
    protected $senderEmail;

    /**
     * @var string $title
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    protected $senderName;

    /**
     * @var string $title
     *
     * @Assert\NotBlank()
     * @Assert\MinLength(limit=4, message="Juste un peu trop court.")
     * @ORM\Column(name="subject", type="string")
     */
    protected $subject;

    /**
     * @var string $content
     *
     * @ORM\Column(name="message", type="text")
     */
    protected $message;

    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    private $captcha;

    public function getCaptcha()
    {
        return $this->captcha;
    }

    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;
        return $this;
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
     * Set senderEmail
     *
     * @param string $senderEmail
     * @return Contact
     */
    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;
        return $this;
    }

    /**
     * Get senderEmail
     *
     * @return string 
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * Set senderName
     *
     * @param string $senderName
     * @return Contact
     */
    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
        return $this;
    }

    /**
     * Get senderName
     *
     * @return string 
     */
    public function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Contact
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
     * Set message
     *
     * @param text $message
     * @return Contact
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
     * @return Contact
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
}