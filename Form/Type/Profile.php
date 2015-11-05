<?php
/**
 * NovaeZFOSUserBundle Profile
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
 * Class Profile
 */
class Profile extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')->add('lastname')->add('isCertified');
        $builder->addViewTransformer( new UserWrappedToUser());
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'fos_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'novactive_ezfosuser_profile';
    }
}
