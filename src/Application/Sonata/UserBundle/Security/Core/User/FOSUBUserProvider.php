<?php

namespace Application\Sonata\UserBundle\Security\Core\User;
 
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
 
class FOSUBUserProvider extends BaseClass
{
 
    /**
     * {@inheritDoc}
     */
    public function connect($user, UserResponseInterface $response)
    {
        //on connect - get the access token
        $serviceAccessTokenName = $response->getResourceOwner()->getName() . 'AccessToken';
        $serviceAccessTokenSetter = 'set' . ucfirst($serviceAccessTokenName);
 
        $user->$serviceAccessTokenSetter($response->getAccessToken());
 
        //you may want to get extra data... put code here.
        $this->userManager->updateUser($user);
    }
 
    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $data = $response->getResponse();

        $user = $this->userManager->findUserBy(array('email' => $data['email']));
        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($data['id']);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($response->getAccessToken() + '&éà&_çà&"(é"jrà7102U\'4\[2A*fŝm$sj&');
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return $user;
        }
 
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
 
        //update access token
        $user->$setter($response->getAccessToken());
 
        return $user;
    }
 
}