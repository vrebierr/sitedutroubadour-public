<?php

namespace Application\Sonata\UserBundle\Controller;

use Sonata\UserBundle\Controller\ProfileController as BaseController;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\FOSUserEvents;

class ProfileController extends BaseController
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $users = $em->getRepository('ApplicationSonataUserBundle:User')->findBy(array('enabled' => true));

        return $this->render('ApplicationSonataUserBundle:User:index.html.twig', array(
            'users' => $users,
            ));
    }

	public function profileAction(User $user)
	{
		if (!$user->isEnabled())
			throw new AccessDeniedException('Cet utilisateur a été désactivé');

		return $this->render('ApplicationSonataUserBundle:User:show.html.twig', array(
			'user' => $user,
			));
	}

	/**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function editAuthenticationAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $formFactory = $this->container->get('sonata_user_authentication_form_factory');
        $form = $formFactory->createForm();
        $form->setData($user);

        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');
                /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
                $dispatcher = $this->container->get('event_dispatcher');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->get('router')->generate('sonata_user_profile_edit_authentication');
                    $response = $this->redirect($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        return $this->render('SonataUserBundle:Profile:edit_authentication.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function editProfileAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->container->get('sonata.user.profile.form');
        $formHandler = $this->container->get('sonata.user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->generateUrl('sonata_user_profile_edit'));
        }

        return $this->render('SonataUserBundle:Profile:edit_profile.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function userCountAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('ApplicationSonataUserBundle:User')->findBy(array('enabled' => true));

        return new Response(count($news));
    }
}