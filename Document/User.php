<?php
/**
 * NovaeZFOSUserBundle User
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class User
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * Identifier
     *
     * @var int Identifier
     *
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * Last Name
     *
     * @var string
     *
     * @MongoDB\String
     */
    protected $lastname;

    /**
     * First Name
     *
     * @var string
     *
     * @MongoDB\String
     */
    protected $firstname;

    /**
     * @var bool
     *
     * @MongoDB\Boolean
     */
    protected $isCertified;


    /**
     * @var array
     *
     * @MongoDB\Collection
     */
    protected $certifiedDates;

    /**
     * Get the Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the IsCertified
     *
     * @return boolean
     */
    public function getIsCertified()
    {
        return $this->isCertified;
    }

    /**
     * Set the IsCertified
     *
     * @param boolean $isCertified isCertified
     *
     * @return $this
     */
    public function setIsCertified($isCertified)
    {
        $this->isCertified = $isCertified;

        return $this;
    }

    /**
     * Get the CertifiedDates
     *
     * @return array
     */
    public function getCertifiedDates()
    {
        return $this->certifiedDates;
    }

    /**
     * Set the CertifiedDates
     *
     * @param array $certifiedDates certifiedDates
     *
     * @return $this
     */
    public function setCertifiedDates($certifiedDates)
    {
        $this->certifiedDates = $certifiedDates;

        return $this;
    }

    /**
     * Get the Lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the Lastname
     *
     * @param string $lastname lastname
     *
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the Firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the Firstname
     *
     * @param string $firstname firstname
     *
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }
}