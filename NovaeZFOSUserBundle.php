<?php
/**
 * NovaeZFOSUserBundle Bundle
 *
 * @package   Novactive\Bundle\eZFOSUserBundle
 * @author    Novactive <dir.tech@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZFOSUserBundle/blob/master/LICENSE MIT Licence
 */
namespace Novactive\Bundle\eZFOSUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class NovaeZFOSUserBundle
 */
class NovaeZFOSUserBundle extends Bundle
{
    /**
     * Extends FOS
     *
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
