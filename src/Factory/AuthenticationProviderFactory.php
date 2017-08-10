<?php
/**
 * Created by PhpStorm.
 * User: judzhin
 * Date: 02.08.17
 * Time: 17:50
 */

namespace MSBios\Guard\CPanel\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use MSBios\Guard\CPanel\Provider\Identity\AuthenticationProvider;
use MSBios\Guard\Module;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationProviderFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Config $config */
        $config = $container->get(Module::class);

        /** @var AuthenticationProvider $provider */
        $provider = new AuthenticationProvider(
            $container->get(AuthenticationService::class)
        );

        return $provider->setDefaultRole($config->get('default_role'))
            ->setAuthenticatedRole($config->get('authenticated_role'));
    }
}
