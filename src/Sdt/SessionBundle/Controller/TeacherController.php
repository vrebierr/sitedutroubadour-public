<?php

namespace Sdt\SessionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sdt\SessionBundle\Entity\Teacher;
use Sdt\SessionBundle\Form\TeacherType;

class TeacherController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $teachers = $em->getRepository('SdtSessionBundle:Teacher')->findBy(array('locked' => false, 'enabled' => true));

        return $this->render('SdtSessionBundle:Teacher:index.html.twig', array(
            'teachers' => $teachers,
            ));
    }

    public function showAction(Teacher $teacher)
    {
        return $this->render('SdtSessionBundle:Teacher:show.html.twig', array(
            'teacher' => $teacher,
            ));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function createAction()
    {
        $form = $this->createForm(new TeacherType());

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
