<?php

namespace Sdt\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\ForumBundle\Entity\Topic;
use Sdt\ForumBundle\Form\PostType;
use Sdt\ForumBundle\Entity\Post;

class TopicController extends Controller
{
	public function showAction(Topic $topic)
	{
		if (!$topic->getEnabled())
			throw new AccessDeniedException('Ce topic a été supprimé.');

		$form = $this->createForm(new PostType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $this->addPost($form, $topic);
            }
        }
        
		$that = $this;
		$breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Forum', $this->get('router')->generate('SdtForumBundle_forum_index'));
        $breadcrumbs->addObjectTree($topic->getForum(), 'Name', function($object) use ($that) {
    		return $that->generateUrl('SdtForumBundle_forum_show', array('slug' => $object->getSlug()));
			}, $parent = 'Parent', $translationParameters = array(), $firstPosition = -1);
        $breadcrumbs->addItem($topic->getSubject());

		$em = $this->getDoctrine()->getEntityManager();

		$posts = $em->getRepository('SdtForumBundle:Post')->findBy(array('topic' => $topic));

		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$posts,
			$this->get('request')->query->get('page', 1)/*page number*/,
			30/*limit per page*/
		);

		return $this->render('SdtForumBundle:Topic:show.html.twig', array(
			'topic' => $topic,
			'pagination' => $pagination,
			'form' => $form->createView(),
			));
	}

	/**
     * @Secure(roles="ROLE_USER")
     */
	public function addPost($form, $topic)
	{
		$post = $form->getData();
        $post->setTopic($topic);
        $post->setAuthor($this->container->get('security.context')->getToken()->getUser());

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($post);
        $em->flush();

        return $this->redirect($this->generateUrl('SdtForumBundle_topic_show', array('slug' => $topic->getSlug())));
	}
}