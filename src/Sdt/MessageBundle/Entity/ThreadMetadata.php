<?php

namespace Sdt\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Ornicar\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="message_thread_metadata")
 */
class ThreadMetadata extends BaseThreadMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Sdt\MessageBundle\Entity\Thread", inversedBy="metadata")
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $participant;

}