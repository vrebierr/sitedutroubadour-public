<?php

namespace Application\Sonata\MediaBundle\Controller;

use Sonata\MediaBundle\Controller\MediaController as BaseController;
use Application\Sonata\MediaBundle\Entity\Media;
use JMS\SecurityExtraBundle\Annotation\Secure;

class MediaController extends BaseController
{
    /**
     * @Secure(roles="ROLE_USER")
     */
	public function uploadAction($provider = null)
	{
        $providers = $this->get('sonata.media.pool')->getProvidersByContext($this->get('request')->get('context', 'default'));
        $request = $this->get('request');

        if ($provider == null)
        {
            $provider = $request->query->get('provider');
        }

        if (!$provider) {
            return $this->render('ApplicationSonataMediaBundle:Media:select_provider.html.twig', array(
                'providers' => $providers,
                ));
        }

        $builder = $this->createFormBuilder();
        $builder->add('Media', 'sonata_media_type', array(
            'provider' => $provider,
            'context'  => 'default',
        ));

        $form = $builder->getForm();

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $data = $form->getData();
                $media = $data['Media'];
                $media->setAuthorName($this->container->get('security.context')->getToken()->getUser()->getUsername());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($media);
                $em->flush();

                return $this->redirect($this->generateUrl('sonata_media_view', array('id' => $media->getId())));
            }
        }

        return $this->render('ApplicationSonataMediaBundle:Media:create.html.twig', array(
            'form' => $form->createView(),
            'provider' => $provider,
            ));
	}
}