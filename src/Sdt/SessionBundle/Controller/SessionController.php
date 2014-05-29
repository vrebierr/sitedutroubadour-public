<?php

namespace Sdt\SessionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

class SessionController extends Controller
{
    /**
     * @Secure(roles="ROLE_USER")
     */
    public function createAction()
    {
        $form = $this->createForm(new SessionType());

        $request = $this->get('request');

        if ($request->getMethod() == "POST")
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                $teacher = $form->getData();
                $teacher->setUser($this->container->get('security.context')->getToken()->getUser());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($teacher);
                $em->flush();

                return $this->redirect($this->generateUrl('SdtTeacherBundle_teacher_show', array('id' => $teacher->getId())));
            }
        }

        return $this->render('SdtSessionBundle:Teacher:create.html.twig', array(
            'form' => $form->createView(),
            ));
    }
}
