<?php
/**
 * NovaeZFOSUserBundle SecurityListener
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Listener;

use eZ\Publish\Core\MVC\Symfony\Security\EventListener\SecurityListener as BaseSecurityListener;
use Symfony\Component\Security\Core\User\UserInterface;
use eZ\Publish\API\Repository\Values\User\User as APIUser;
use Novactive\Bundle\eZFOSUserBundle\Core\UserWrapped;

/**
 * Class SecurityListener
 */
class SecurityListener extends BaseSecurityListener
{
    /**
     * Get the User
     *
     * @param UserInterface $originalUser
     * @param APIUser       $apiUser
     *
     * @return UserWrapped
     */
    protected function getUser(UserInterface $originalUser, APIUser $apiUser)
    {
        return new UserWrapped($originalUser, $apiUser);
    }
}
