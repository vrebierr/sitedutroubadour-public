<?php

namespace Sdt\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ornicar\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="message_message_metadata")
 */
class MessageMetadata extends BaseMessageMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Sdt\MessageBundle\Entity\Message", inversedBy="metadata")
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $participant;
}