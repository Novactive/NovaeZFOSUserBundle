<?php
/**
 * NovaeZFOSUserBundle UserWrapped
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Core;

use eZ\Publish\Core\MVC\Symfony\Security\UserWrapped as BaseUserWrapped;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class UserWrapped
 */
class UserWrapped extends BaseUserWrapped implements UserInterface
{

    /**
     * Get Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->getInterfacedUser()->getId();
    }

    /**
     * GetInterfacedUser (sugar)
     *
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function getInterfacedUser()
    {
        return $this->getWrappedUser();
    }

    /**
     * Adds a role to the user.
     *
     * @param string $role
     *
     * @return self
     */
    public function addRole($role)
    {
        return $this->getInterfacedUser()->addRole($role);
    }

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the SecurityContext, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $securityContext->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        return $this->getInterfacedUser()->hasRole($role);
    }

    /**
     * Sets the roles of the user.
     *
     * This overwrites any previous roles.
     *
     * @param array $roles
     *
     * @return self
     */
    public function setRoles(array $roles)
    {
        return $this->getInterfacedUser()->setRoles($roles);
    }

    /**
     * Removes a role to the user.
     *
     * @param string $role
     *
     * @return self
     */
    public function removeRole($role)
    {
        return $this->getinterfacedUser()->removeRole($role);
    }

    /**
     * Gets the canonical email in search and sort queries.
     *
     * @return string
     */
    public function getEmailCanonical()
    {
        return $this->getInterfacedUser()->getEmailCanonical();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(
            [
                "w" => $this->getInterfacedUser(),
                "a" => $this->getAPIUser()
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $this->setWrappedUser($data['w']);
        $this->setAPIUser($data['a']);
    }

    /**
     * Sets the username.
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->getInterfacedUser()->setUsername($username);

        return $this;
    }

    /**
     * Gets the canonical username in search and sort queries.
     *
     * @return string
     */
    public function getUsernameCanonical()
    {
        return $this->getInterfacedUser()->getEmailCanonical();
    }

    /**
     * Sets the canonical username.
     *
     * @param string $usernameCanonical
     *
     * @return self
     */
    public function setUsernameCanonical($usernameCanonical)
    {
        $this->getInterfacedUser()->setUsernameCanonical($usernameCanonical);

        return $this;
    }

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getInterfacedUser()->getEmail();
    }

    /**
     * Sets the email.
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->getInterfacedUser()->setEmail($email);

        return $this;
    }

    /**
     * Sets the canonical email.
     *
     * @param string $emailCanonical
     *
     * @return self
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->getInterfacedUser()->setEmailCanonical($emailCanonical);

        return $this;
    }

    /**
     * Gets the plain password.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->getInterfacedUser()->getPlainPassword();
    }

    /**
     * Sets the plain password.
     *
     * @param string $password
     *
     * @return self
     */
    public function setPlainPassword($password)
    {
        $this->getInterfacedUser()->setPlainPassword($password);

        return $this;
    }

    /**
     * Sets the hashed password.
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->getInterfacedUser()->setPassword($password);

        return $this;
    }

    /**
     * Tells if the the given user has the super admin role.
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->getInterfacedUser()->isSuperAdmin();
    }

    /**
     * Set Enabled
     *
     * @param boolean $boolean
     *
     * @return self
     */
    public function setEnabled($boolean)
    {
        $this->getInterfacedUser()->setEnabled($boolean);

        return $this;
    }

    /**
     * Sets the locking status of the user.
     *
     * @param boolean $boolean
     *
     * @return self
     */
    public function setLocked($boolean)
    {
        $this->getInterfacedUser()->setLocked($boolean);

        return $this;
    }

    /**
     * Sets the super admin status
     *
     * @param boolean $boolean
     *
     * @return self
     */
    public function setSuperAdmin($boolean)
    {
        $this->getInterfacedUser()->setSuperAdmin($boolean);

        return $this;
    }

    /**
     * Gets the confirmation token.
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->getInterfacedUser()->getConfirmationToken();
    }

    /**
     * Sets the confirmation token
     *
     * @param string $confirmationToken
     *
     * @return self
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->getInterfacedUser()->setConfirmationToken($confirmationToken);

        return $this;
    }

    /**
     * Sets the timestamp that the user requested a password reset.
     *
     * @param null|\DateTime $date
     *
     * @return self
     */
    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        $this->getInterfacedUser()->setPasswordRequestedAt($date);

        return $this;
    }

    /**
     * Checks whether the password reset request has expired.
     *
     * @param integer $ttl Requests older than this many seconds will be considered expired
     *
     * @return boolean true if the user's password request is non expired, false otherwise
     */
    public function isPasswordRequestNonExpired($ttl)
    {
        return $this->getInterfacedUser()->isPasswordRequestNonExpired($ttl);
    }

    /**
     * Sets the last login time
     *
     * @param \DateTime $time
     *
     * @return self
     */
    public function setLastLogin(\DateTime $time = null)
    {
        $this->getInterfacedUser()->setLastLogin($time);

        return $this;
    }
}
