<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Authentication\AuthenticationService;
use MSBios\Guard\CPanel\Provider\Identity\AuthenticationProvider;
use MSBios\Guard\Module;
use Zend\Config\Config;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AuthenticationProviderFactory
 * @package MSBios\Guard\CPanel\Factory
 */
class AuthenticationProviderFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return $this
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Config $config */
        $config = $container->get(Module::class);

        /** @var AuthenticationProvider $provider */
        $provider = (new AuthenticationProvider(
            $container->get(AuthenticationService::class)
        ));

        return $provider->setDefaultRole($config->get('default_role'))
            ->setAuthenticatedRole($config->get('authenticated_role'));
    }
}
