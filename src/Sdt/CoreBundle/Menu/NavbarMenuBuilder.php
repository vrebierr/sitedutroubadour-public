<?php

namespace Sdt\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class NavbarMenuBuilder extends AbstractNavbarMenuBuilder
{
    protected $securityContext;
    protected $isLoggedIn;

    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        parent::__construct($factory);

        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function mainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        $menu->addChild('Tutoriels', array('route' => 'SdtTutorialBundle_tutorial_index'));
        $menu->addChild('Forums', array('route' => 'SdtForumBundle_forum_category_index'));
        $menu->addChild('Partitions', array('route' => 'SdtScoreBundle_score_index'));
        $menu->addChild('Annonces', array('route' => 'SdtAdvertBundle_advert_index'));

        return $menu;
    }

    public function logbox(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');


        if ($this->isLoggedIn) {
            $dropdown = $this->createDropdownMenuItem($menu, $this->securityContext->getToken()->getUser()->getUsername(), false, array('icon' => 'caret'));

            $dropdown->addChild('Profil', array('route' => 'sonata_user_profile_show'));
            $dropdown->addChild('Identifiants', array('route' => 'sonata_user_profile_edit_authentication'));
            $dropdown->addChild('Messages', array('route' => 'ornicar_message_inbox'));
            $menu->addChild('Déconnexion', array('route' => 'fos_user_security_logout'));
        } else {
            $menu->addChild('Connexion', array('route' => 'fos_user_security_login'));
            $menu->addChild('Inscription', array('route' => 'fos_user_registration_register'));
        }

        return $menu;
    }
}