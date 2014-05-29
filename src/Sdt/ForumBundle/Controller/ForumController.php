<?php

namespace Sdt\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\ForumBundle\Entity\Forum;
use Sdt\ForumBundle\Form\TopicType;
use Sdt\ForumBundle\Entity\Post;

class ForumController extends Controller
{
    public function showAction(Forum $forum)
    {
        $form = $this->createForm(new TopicType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $this->addTopic($form, $forum);
            }
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Forum', $this->get('router')->generate('SdtForumBundle_forum_index'));
        $breadcrumbs->addObjectTree($forum, 'Name', $url = 'Slug', $parent = 'Parent', $translationParameters = array(), $firstPosition = -1);

        $em = $this->getDoctrine()->getEntityManager();

        $childs = $em->getRepository('SdtForumBundle:Forum')->children($forum);
        $req = $em->getRepository('SdtForumBundle:Forum')->children($forum, false, false, false, true);

        $topics = $em->getRepository('SdtForumBundle:Topic')->findBy(array('forum' => $req, 'enabled' => true), array('pulledAt' => 'DESC'));

        $paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
		    $topics,
		    $this->get('request')->query->get('page', 1)/*page number*/,
		    50/*limit per page*/
        );

    	return $this->render('SdtForumBundle:Forum:show.html.twig', array(
            'forum' => $forum,
            'childs' =>  $childs,
            'pagination' => $pagination,
            'form' => $form->createView(),
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function addTopic($form, $forum)
    {
        $topic = $form->getData();
        $topic->setForum($forum);
        $topic->setAuthor($this->container->get('security.context')->getToken()->getUser());

        $post = new Post();
        $post->setTopic($topic);
        $post->setMessage($topic->getMessage());
        $post->setAuthor($this->container->get('security.context')->getToken()->getUser());

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($topic);
        $em->flush();

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($post);
        $em->flush();

        return $this->redirect($this->generateUrl('SdtForumBundle_topic_show', array('slug' => $topic->getSlug())));
    }

    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Forum');

        $em = $this->getDoctrine()->getEntityManager();

        $forums = $em->getRepository('SdtForumBundle:Forum')->findBy(array('lvl' => 0));
        $childs = $em->getRepository('SdtForumBundle:Forum')->findBy(array('lvl' => 1));

        return $this->render('SdtForumBundle:Forum:index.html.twig', array(
            'forums' => $forums,
            'childs' => $childs,
            ));
    }
}
