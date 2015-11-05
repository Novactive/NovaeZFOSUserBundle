<?php
/**
 * NovaeZFOSUserBundle UserManager
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Doctrine;

use Novactive\Bundle\eZFOSUserBundle\Document\User;
use Novactive\Bundle\eZFOSUserBundle\Core\UserWrapped;
use FOS\UserBundle\Doctrine\UserManager as FOSUserManager;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class UserManager
 */
class UserManager extends FOSUserManager
{

    /**
     * {@inheritdoc}
     */
    public function updateUser(UserInterface $user, $andFlush = true)
    {
        if ($user instanceof UserWrapped) {
            parent::updateUser($user->getInterfacedUser(), $andFlush);

            return;
        }
        parent::updateUser($user, $andFlush);
    }

    /**
     * {@inheritdoc}
     */
    public function reloadUser(UserInterface $user)
    {
        if ($user instanceof UserWrapped) {
            parent::reloadUser($user->getInterfacedUser());

            return;
        }
        parent::reloadUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteUser(UserInterface $user)
    {
        if ($user instanceof UserWrapped) {
            parent::deleteUser($user->getInterfacedUser());

            return;
        }
        parent::deleteUser($user);
    }

    /**
     * {@inheritdoc}
     */
    protected function getEncoder(UserInterface $user)
    {
        if ($user instanceof UserWrapped) {
            return parent::getEncoder($user->getInterfacedUser());
        }

        return parent::getEncoder($user);
    }

    /**
     * {@inheritDoc}
     */
    public function updateCanonicalFields(UserInterface $user)
    {
        if ($user instanceof UserWrapped) {
            parent::updateCanonicalFields($user->getInterfacedUser());

            return;
        }
        parent::updateCanonicalFields($user);
    }

    /**
     * {@inheritDoc}
     */
    public function updatePassword(UserInterface $user)
    {
        if ($user instanceof UserWrapped) {
            parent::updatePassword($user->getInterfacedUser());

            return;
        }
        parent::updatePassword($user);
    }
}
