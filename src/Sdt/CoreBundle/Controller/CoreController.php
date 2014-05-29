<?php

namespace Sdt\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Sdt\CoreBundle\Form\ContactType;

class CoreController extends Controller
{
	public function homepageAction()
	{
		$em = $this->getDoctrine()->getManager();

        $unes = $em->getRepository('SdtTutorialBundle:Tutorial')->findBy(array('status' => 'published'), array('createdAt' => 'desc'), 5, 0);
        $news = $em->getRepository('SdtNewsBundle:News')->findBy(array('status' => 'published'), array('createdAt' => 'desc'), 5, 0);
        $tutos = $em->getRepository('SdtTutorialBundle:Tutorial')->findBy(array('status' => 'published'), array('createdAt' => 'desc'), 5, 0);

        return $this->render('SdtCoreBundle:Core:homepage.html.twig', array(
            'unes' => $unes,
            'news' => $news,
            'tutos' => $tutos,
        ));
	}

	public function rulesAction()
	{
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Mentions légales');

		return $this->render('SdtCoreBundle:Core:rules.html.twig');
	}

	public function contactAction()
	{
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Formulaire de contact');

		$form = $this->createForm(new ContactType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
            	$contact = $form->getData();

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($contact);
                $em->flush();

                $mailer = $this->container->get('mailer');

                $mail = \Swift_Message::newInstance()
                    ->setSubject('[Contact] ' . $contact->getSubject())
                    ->setFrom($contact->getSenderEmail(), $contact->getSenderName())
                    ->setTo('valentin.rebierre@gmail.com')
                    ->setBody($contact->getMessage());

                $mailer->send($mail);

                $this->get('session')->setFlash('notice', 'Votre message a bien été envoyée.');

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('SdtCoreBundle:Core:contact.html.twig', array(
            'form' => $form->createView(),
            ));
	}

    public function searchAction()
    {
        $query = $this->get('request')->query->get('q');

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Recherche', $this->get('router')->generate('search'));
        $breadcrumbs->addItem($query);
        
        return $this->render('SdtCoreBundle:Core:search.html.twig', array(
            'query' => $query
            ));
    }
}