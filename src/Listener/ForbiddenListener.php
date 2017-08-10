<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel\Listener;

use MSBios\CPanel\Mvc\Controller\ActionControllerInterface;
use MSBios\Guard\CPanel\Form\LoginForm;
use MSBios\Guard\CPanel\Module;
use Zend\Config\Config;
use Zend\EventManager\EventInterface;
use Zend\Router\RouteMatch;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

/**
 * Class ForbiddenListener
 * @package MSBios\Guard\CPanel\Listener
 */
class ForbiddenListener
{
    /**
     * @param EventInterface $event
     */
    public function onUnAuthorized(EventInterface $event)
    {
        /** @var string $error */
        $error = $event->getError();

        if (empty($error)) {
            return;
        }

        /** @var ViewModel $viewModel */
        $viewModel = $event->getViewModel();

        if (! $viewModel instanceof ViewModel) {
            return;
        }

        /** @var RouteMatch $routeMatch */
        $routeMatch = $event->getRouteMatch();

        if (is_null($routeMatch)) {
            return;
        }

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $event->getTarget()->getServiceManager();

        // /** @var Config $options */
        // $options = $serviceManager->get(Module::class);
        //
        // /** @var \Reflection $reflection */
        // $reflection = new \ReflectionClass($routeMatch->getParam('controller'));

        /** @var ViewModel $child */
        foreach ($viewModel->getChildren() as $child) {
            $child->setVariables([
                'form' => $serviceManager->get('FormElementManager')
                    ->get(LoginForm::class)
            ]);
        }
    }
}
