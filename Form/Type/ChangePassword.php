<?php
/**
 * NovaeZFOSUserBundle ChangePassword
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */

namespace Novactive\Bundle\eZFOSUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Novactive\Bundle\eZFOSUserBundle\Form\DataTransformer\UserWrappedToUser;

/**
 * Class ChangePassword
 */
class ChangePassword extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new UserWrappedToUser());
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'fos_user_change_password';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'novactive_ezfosuser_change_password';
    }
}
