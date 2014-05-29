<?php

namespace Sdt\AdvertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\AdvertBundle\Entity\Advert;
use Sdt\AdvertBundle\Form\AdvertType;
use Sdt\AdvertBundle\Form\AdvertSearchType;
use Doctrine\Common\Collections\ArrayCollection;

class AdvertController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm(new AdvertSearchType());

        $request = $this->get('request');
        $em = $this->getDoctrine()->getEntityManager();

        if ($request->getMethod() == 'GET')
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $data = $form->getData();
                $adverts = $em->getRepository('SdtAdvertBundle:Advert')->search($data['category'], $data['ageMin'], $data['ageMax'], $data['locale']);

                $result = new ArrayCollection();

                foreach ($adverts as $advert) {
                    if (in_array($advert->getCategory(), $data['lookingFor']->toArray()))
                        $result->add($advert);
                }

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $result,
                    $this->get('request')->query->get('page', 1)/*page number*/,
                    40/*limit per page*/
                );

                return $this->render('SdtAdvertBundle:Advert:index.html.twig', array(
                    'pagination' => $pagination,
                    'form' => $form->createView(),
                    ));
            }
        }

        $adverts = $em->getRepository('SdtAdvertBundle:Advert')->findAllDefault();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $adverts,
            $this->get('request')->query->get('page', 1)/*page number*/,
            40/*limit per page*/
        );

        return $this->render('SdtAdvertBundle:Advert:index.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
            ));
    }

    public function showAction(Advert $advert)
    {
        return $this->render('SdtAdvertBundle:Advert:show.html.twig', array(
            'advert' => $advert,
            ));
    }

	/**
     * @Secure(roles="ROLE_USER")
     */
	public function createAction()
	{
		$form = $this->createForm(new AdvertType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $advert = $form->getData();
                $advert->setAuthor($this->container->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($advert);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtAdvertBundle_advert_show', array('id' => $advert->getId(), 'slug' => $advert->getSlug())));
            }
        }

        return $this->render('SdtAdvertBundle:Advert:create.html.twig', array(
            'form' => $form->createView(),
            ));
	}

	/**
     * @Secure(roles="ROLE_USER")
     */
	public function updateAction(Advert $advert)
	{
		if ($advert->getAuthor() != $this->container->get('security.context')->getToken()->getUser())
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à modifier cette annonce');

		$editForm = $this->createForm(new AdvertType(), $advert);

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $editForm->bindRequest($request);

            if ($editForm->isValid())
            {
                $advert = $editForm->getData();

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($advert);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtAdvertBundle_advert_update', array('id' => $advert->getId(), 'slug' => $advert->getSlug())));
            }
        }

        return $this->render('SdtAdvertBundle:Advert:update.html.twig', array(
            'edit_form' => $editForm->createView(),
            'advert' => $advert,
            ));
	}
}