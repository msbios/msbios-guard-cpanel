<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Guard\CPanel\Factory;


use Interop\Container\ContainerInterface;
use MSBios\Guard\CPanel\Authentication\Storage\ResourceStorage;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AuthenticationResourceStorageFactory
 * @package MSBios\Guard\CPanel\Factory
 */
class AuthenticationResourceStorageFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ResourceStorage
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ResourceStorage;
    }
}