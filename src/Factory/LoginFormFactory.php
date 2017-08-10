<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Guard\CPanel\Form\LoginForm;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class LoginFormFactory
 * @package MSBios\Guard\CPanel\Factory
 */
class LoginFormFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return LoginForm
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new LoginForm;
    }
}
