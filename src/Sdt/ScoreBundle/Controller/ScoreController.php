<?php

namespace Sdt\ScoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\ScoreBundle\Form\ScoreSearchType;
use Sdt\ScoreBundle\Form\ScoreType;
use Sdt\ScoreBundle\Entity\ScoreCategory;
use Sdt\ScoreBundle\Entity\Score;

class ScoreController extends Controller
{
	public function indexAction()
	{
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Partitons');

		$form = $this->createForm(new ScoreSearchType());

        $request = $this->get('request');

        if ($request->getMethod() == 'GET')
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $data = $form->getData();

                $scores = $em->getRepository('SdtScoreBundle:Score')->search($data['artist'], $data['song'], $data['category']);

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $scores,
                    $this->get('request')->query->get('page', 1)/*page number*/,
                    40/*limit per page*/
                );
            }
            else
            {
                $em = $this->getDoctrine()->getEntityManager();
                $scores = $em->getRepository('SdtScoreBundle:Score')->findBy(array('enabled' => true), array('createdAt' => 'desc'));

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $scores,
                    $this->get('request')->query->get('page', 1)/*page number*/,
                    40/*limit per page*/
                );
            }
        }
        

        return $this->render('SdtScoreBundle:Score:index.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
            ));
	}

	public function showAction(Score $score)
	{
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Partitons', $this->get('router')->generate('SdtScoreBundle_score_index'));
        $breadcrumbs->addItem($score->getArtist().' - '.$score->getSong());

        if(!$score->getEnabled())
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à visualiser cette partition.');

		return $this->render('SdtScoreBundle:Score:show.html.twig', array(
			'score' => $score,
			));
	}

    /**
     * @Secure(roles="ROLE_USER")
     */
	public function createAction()
	{
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem('Accueil', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Partitons', $this->get('router')->generate('SdtScoreBundle_score_index'));
        $breadcrumbs->addItem('Nouvelle partition');

		$form = $this->createForm(new ScoreType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $score = $form->getData();
                $score->setUploader($this->container->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($score);
                $em->flush();

                $this->get('session')->setFlash('notice', 'Votre partition a bien été envoyée.');

                return $this->redirect($this->generateUrl('SdtScoreBundle_score_create'));
            }
        }

        return $this->render('SdtScoreBundle:Score:create.html.twig', array(
            'form' => $form->createView(),
            ));
	}
}