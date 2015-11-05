<?php
/**
 * NovaeZFOSUserBundle ImplicitLoginListener
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */
namespace Novactive\Bundle\eZFOSUserBundle\Listener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use eZ\Publish\Core\MVC\Symfony\Security\UserInterface as eZUser;
use eZ\Publish\API\Repository\UserService;
use Symfony\Component\Security\Core\User\UserInterface;
use eZ\Publish\Core\MVC\Symfony\Event\InteractiveLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use eZ\Publish\API\Repository\Repository;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use eZ\Publish\Core\MVC\Symfony\MVCEvents;
use eZ\Publish\Core\MVC\Symfony\Security\InteractiveLoginToken;
use Novactive\Bundle\eZFOSUserBundle\Core\UserWrapped;

/**
 * Class ImplicitLoginListener
 */
class ImplicitLoginListener implements EventSubscriberInterface
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var ConfigResolverInterface
     */
    protected $configResolver;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(
        Repository $repository,
        ConfigResolverInterface $configResolver,
        EventDispatcherInterface $eventDispatcher,
        TokenStorageInterface $tokenStorage
    ) {
        $this->repository      = $repository;
        $this->configResolver  = $configResolver;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenStorage    = $tokenStorage;
    }


    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin'
        );
    }

    /**
     * @param UserEvent $event
     */
    public function onImplicitLogin(UserEvent $event)
    {
        $originalUser = $event->getUser();
        if ($originalUser instanceof eZUser || !$originalUser instanceof UserInterface) {
            return;
        }

        // Already Authenticated Token ( we are in ImplicitLogin of FOS)
        $token = $this->tokenStorage->getToken();

        $subLoginEvent = new InteractiveLoginEvent($event->getRequest(), $token);
        $this->eventDispatcher->dispatch(MVCEvents::INTERACTIVE_LOGIN, $subLoginEvent);
        if ($subLoginEvent->hasAPIUser()) {
            $apiUser = $subLoginEvent->getAPIUser();
        }
        else {
            $apiUser = $this->repository->getUserService()->loadUser(
                $this->configResolver->getParameter('anonymous_user_id')
            );
        }
        $this->repository->setCurrentUser($apiUser);
        $providerKey      = method_exists($token, 'getProviderKey') ? $token->getProviderKey() : __CLASS__;
        $interactiveToken = new InteractiveLoginToken(
            new UserWrapped($originalUser, $apiUser),
            get_class($token),
            $token->getCredentials(),
            $providerKey,
            $token->getRoles()
        );
        $interactiveToken->setAttributes($token->getAttributes());
        $this->tokenStorage->setToken($interactiveToken);
    }

}
