<?php

namespace Sdt\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sdt\TutorialBundle\Entity\TutorialCategory;

class TutorialCategoryController extends Controller
{
    public function showAction(TutorialCategory $tutorialCategory)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $tutos = $em->getRepository('SdtTutorialBundle:Tutorial')->findBy(array('category' => $tutorialCategory, 'status' => 'published'));

    	return $this->render('SdtTutorialBundle:TutorialCategory:show.html.twig', array(
            'tutos' => $tutos,
            'category' => $tutorialCategory,
            ));
    }
}
