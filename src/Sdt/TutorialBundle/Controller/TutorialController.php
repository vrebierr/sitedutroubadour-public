<?php

namespace Sdt\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\TutorialBundle\Entity\Tutorial;
use Sdt\TutorialBundle\Form\TutorialType;

class TutorialController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $tutos = $em->getRepository('SdtTutorialBundle:Tutorial')->findBy(array('status' => 'published'));

        return $this->render('SdtTutorialBundle:Tutorial:index.html.twig', array(
            'tutos' => $tutos,
            ));
    }

    public function showAction(Tutorial $tuto)
    {
        if ($tuto->getStatus() != 'published')
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à visualiser ce tutoriel');

        return $this->render('SdtTutorialBundle:Tutorial:show.html.twig', array(
            'tuto' => $tuto,
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function myTutorialsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $tutos = $em->getRepository('SdtTutorialBundle:Tutorial')->findBy(array(
            'status' => 'draft',
            'author' => $this->container->get('security.context')->getToken()->getUser()
            ));

        return $this->render('SdtTutorialBundle:Tutorial:myTutorials.html.twig', array(
            'tutos' => $tutos,
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function previewAction(Tutorial $tuto)
    {
        if ($tuto->getAuthor() != $this->container->get('security.context')->getToken()->getUser() && $tuto->getStatus() == 'published')
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier ce tutoriel');

        return $this->render('SdtTutorialBundle:Tutorial:preview.html.twig', array(
            'tuto' => $tuto,
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
	public function createAction()
	{
		$form = $this->createForm(new TutorialType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $tuto = $form->getData();
                $tuto->setStatus('draft');
                $tuto->setAuthor($this->container->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($tuto);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtTutorialBundle_tutorial_update', array('id' => $tuto->getId())));
            }
        }

        return $this->render('SdtTutorialBundle:Tutorial:create.html.twig', array(
            'form' => $form->createView(),
            ));
	}

    /**
     * @Secure(roles="ROLE_USER")
     */
	public function updateAction(Tutorial $tuto)
	{
        if ($tuto->getAuthor() != $this->container->get('security.context')->getToken()->getUser() || $tuto->getStatus() == 'published')
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier ce tutoriel');

		$editForm = $this->createForm(new TutorialType(), $tuto);

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $editForm->bindRequest($request);

            if ($editForm->isValid())
            {
                $tuto = $editForm->getData();

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($tuto);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtTutorialBundle_tutorial_update', array('id' => $tuto->getId())));
            }
        }

        return $this->render('SdtTutorialBundle:Tutorial:update.html.twig', array(
            'edit_form' => $editForm->createView(),
            'tuto' => $tuto,
            ));
	}

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function validateAction(Tutorial $tuto)
    {
        if ($tuto->getAuthor() != $this->container->get('security.context')->getToken()->getUser() || $tuto->getStatus() == 'published')
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier ce tutoriel');
        
        $tuto->setRequested(true);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($tuto);
        $em->flush();

        /*$em = $this->getDoctrine()->getEntityManager();
        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findBy(array('name' => 'Modérateurs'));
        $all = $em->getRepository('ApplicationSonataUserBundle:User')->findBy(array('enabled' => true));

        foreach ($all as $user)
        {
            if (in_array($user->getGroups(), $group))
                $users[] = $user;
        }

        $threadBuilder = $this->get('ornicar_message.composer')->newThread();

        foreach ($users as $recipient)
            $threadBuilder->addRecipient($recipient);

        $threadBuilder
            ->setSubject($this->container->get('security.context')->getToken()->getUser().' nous propose un nouveau tutoriel !')
            ->setBody($tuto);

        $sender = $this->get('ornicar_message.sender');
        $sender->send($threadBuilder->getMessage()); */
        
        return $this->redirect($this->generateUrl('SdtTutorialBundle_tutorial_update', array('id' => $tuto->getId())));
    }
}