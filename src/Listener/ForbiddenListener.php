<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel\Listener;

use MSBios\CPanel\Mvc\Controller\ActionControllerInterface;
use MSBios\Guard\CPanel\Form\LoginForm;
use MSBios\Guard\CPanel\Module;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ModelInterface;

/**
 * Class ForbiddenListener
 * @package MSBios\Guard\CPanel\Listener
 */
class ForbiddenListener
{
    /**
     * @param EventInterface $e
     */
    public function onDispatchError(EventInterface $e)
    {

        /** @var string $error */
        $error = $e->getError();

        if (empty($error)) {
            return;
        }

        /** @var ModelInterface $viewModel */
        $viewModel = $e->getViewModel();

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $e->getApplication()
            ->getServiceManager();

        if ($e->getTarget() instanceof ActionControllerInterface) {
            $viewModel->setTemplate(
                $serviceManager->get(Module::class)
                    ->get('default_layout_authorized')
            );
        }

        /** @var ModelInterface $child */
        foreach ($viewModel->getChildren() as $child) {
            $child->setVariable(
                'form',
                $serviceManager->get('FormElementManager')->get(LoginForm::class)
            );
        }
    }
}
