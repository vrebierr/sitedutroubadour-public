<?php

namespace Sdt\MessageBundle\Controller;

use Ornicar\MessageBundle\Controller\MessageController as BaseController;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Application\Sonata\UserBundle\Entity\User;

class MessageController extends BaseController
{
    /**
     * @Secure(roles="ROLE_USER")
     */
    public function inboxAction()
    {
        $breadcrumbs = $this->container->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->container->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Messages');

        $threads = $this->getProvider()->getInboxThreads();

        $paginator = $this->container->get('knp_paginator');
        $pagination = $paginator->paginate(
            $threads,
            $this->container->get('request')->query->get('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->container->get('templating')->renderResponse('OrnicarMessageBundle:Message:inbox.html.twig', array(
            'threads' => $threads,
            'pagination' => $pagination,
        ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
	public function newThreadToUserAction(User $user)
	{
        $breadcrumbs = $this->container->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->container->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Messages', $this->container->get('router')->generate('ornicar_message_thread_index'));
        $breadcrumbs->addItem('Nouveau message privé');

		$form = $this->container->get('ornicar_message.new_thread_form.factory')->create();
        $formHandler = $this->container->get('ornicar_message.new_thread_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('ornicar_message_thread_view', array(
                'threadId' => $message->getThread()->getId()
            )));
        }

        return $this->container->get('templating')->renderResponse('OrnicarMessageBundle:Message:newThread.html.twig', array(
            'form' => $form->createView(),
            'data' => $form->getData(),
            'user' => $user,
        ));
	}

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function threadAction($threadId)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->container->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Messages', $this->container->get('router')->generate('ornicar_message_thread_index'));
        $breadcrumbs->addItem($threadId->getSubject());

        $thread = $this->getProvider()->getThread($threadId);
        $form = $this->container->get('ornicar_message.reply_form.factory')->create($thread);
        $formHandler = $this->container->get('ornicar_message.reply_form.handler');

        if ($message = $formHandler->process($form)) {

            /*$mail = \Swift_Message::newInstance()
                ->setSubject('[Site du Troubadour] Vous avez un nouveau message')
                ->setFrom('sitedutroubadour@sitedutroubadour.com')
                ->setTo($message->getSender()->getEmail())
                ->setBody($this->renderView('SdtMessageBundle:Message:email.html.twig', array('message' => $message)))
            ;
            $this->get('mailer')->send($mail); */

            return new RedirectResponse($this->container->get('router')->generate('ornicar_message_thread_view', array(
                'threadId' => $message->getThread()->getId()
            )));
        }

        return $this->container->get('templating')->renderResponse('OrnicarMessageBundle:Message:thread.html.twig', array(
            'form' => $form->createView(),
            'thread' => $thread
        ));
    }
}