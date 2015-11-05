<?php
/**
 * NovaeZFOSUserBundle UserProvider
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Security;

use FOS\UserBundle\Security\EmailUserProvider;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;
use Novactive\Bundle\eZFOSUserBundle\Core\UserWrapped;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Class UserProvider
 */
class UserProvider extends EmailUserProvider
{
    /**
     * {@inheritDoc}
     */
    public function refreshUser(SecurityUserInterface $user)
    {

        if (!$user instanceof UserWrapped) {
            throw new UnsupportedUserException(
                sprintf('Novactive\Bundle\eZFOSUserBundle\Core\UserWrapped, but got "%s".', get_class($user))
            );
        }
        if (null ===
            $reloadedUser = $this->userManager->findUserBy(array( 'id' => $user->getWrappedUser()->getId() ))
        ) {
            throw new UsernameNotFoundException(
                sprintf('User with ID "%d" could not be reloaded.', $user->getWrappedUser()->getId())
            );
        }
        $user->setWrappedUser($reloadedUser);
        throw new UnsupportedUserException("Forward to the ezpublish provider to reload the API User");
    }

}
