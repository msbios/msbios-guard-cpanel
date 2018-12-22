<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel;

use Zend\EventManager\EventInterface;
use Zend\EventManager\LazyListenerAggregate;
use Zend\Mvc\ApplicationInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Module
 * @package MSBios\Guard\CPanel
 */
class Module extends \MSBios\Module
{
    /** @const VERSION */
    const VERSION = '1.0.23';

    /**
     * @inheritdoc
     *
     * @param EventInterface $event
     */
    public function onBootstrap(EventInterface $event)
    {
        /** @var ApplicationInterface $target */
        $target = $event->getTarget();

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $target->getServiceManager();

        (new LazyListenerAggregate(
            $serviceManager->get(self::class)['listeners'],
            $serviceManager
        ))->attach($target->getEventManager());
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function getDir()
    {
        return __DIR__;
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function getNamespace()
    {
        return __NAMESPACE__;
    }
}
