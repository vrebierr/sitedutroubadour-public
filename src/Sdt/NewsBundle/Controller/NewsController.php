<?php

namespace Sdt\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\NewsBundle\Entity\News;
use Sdt\NewsBundle\Form\NewsType;

class NewsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SdtNewsBundle:News')->findBy(array('status' => 'published'));

        return $this->render('SdtNewsBundle:News:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function showAction(News $entity)
    {
        if ($entity->getAuthor() != $this->container->get('security.context')->getToken()->getUser() && $entity->getStatus() != 'published')
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier ce tutoriel');
        
        return $this->render('SdtNewsBundle:News:show.html.twig', array(
            'news' => $entity
        ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function createAction()
    {
        $form = $this->createForm(new NewsType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $news = $form->getData();
                $news->setStatus('published');
                $news->setAuthor($this->container->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($news);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtNewsBundle_news_update', array('id' => $news->getId(), 'slug' => $news->getSlug())));
            }
        }

        return $this->render('SdtNewsBundle:News:create.html.twig', array(
            'form' => $form->createView(),
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function updateAction(News $news)
    {
        if ($news->getAuthor() != $this->container->get('security.context')->getToken()->getUser())
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier cette news');

        $editForm = $this->createForm(new NewsType(), $news);

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $editForm->bindRequest($request);

            if ($editForm->isValid())
            {
                $news = $editForm->getData();

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($news);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtNewsBundle_news_update', array('id' => $news->getId(), 'slug' => $news->getSlug())));
            }
        }

        return $this->render('SdtNewsBundle:News:update.html.twig', array(
            'edit_form' => $editForm->createView(),
            'news' => $news,
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function validateAction(News $news)
    {
        if ($news->getAuthor() != $this->container->get('security.context')->getToken()->getUser())
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier cette news');
        
        $news->setRequested(true);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($news);
        $em->flush();
        
        return $this->redirect($this->generateUrl('SdtNewsBundle_News_update', array('id' => $news->getId(), 'slug' => $news->getSlug())));
    }
}
