<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Guard\CPanel\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Authentication\AuthenticationService;
use MSBios\Guard\CPanel\Controller\AuthenticationController;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AuthenticationControllerFactory
 * @package MSBios\Guard\CPanel\Factory
 */
class AuthenticationControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AuthenticationController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AuthenticationController(
            $container->get(AuthenticationService::class),
            $container
        );
    }
}
