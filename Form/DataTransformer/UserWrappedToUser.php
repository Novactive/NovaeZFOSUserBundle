<?php
/**
 * NovaeZFOSUserBundle UserWrappedToUser
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Novactive\Bundle\eZFOSUserBundle\Core\UserWrapped;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class UserWrappedToUser
 */
class UserWrappedToUser implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if ($value instanceof UserWrapped) {
            return $value->getWrappedUser();
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        return $value;
    }
}
