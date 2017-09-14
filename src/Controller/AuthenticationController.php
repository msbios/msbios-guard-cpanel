<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 *
 */

namespace MSBios\Guard\CPanel\Controller;

use DoctrineModule\Authentication\Adapter\ObjectRepository;
use MSBios\CPanel\Mvc\Controller\ActionControllerInterface;
use MSBios\Guard\CPanel\Form\LoginForm;
use MSBios\Guard\CPanel\Module;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\Redirect;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

/**
 * Class AuthenticationController
 * @package MSBios\Guard\CPanel\Controller
 */
class AuthenticationController extends AbstractActionController implements ActionControllerInterface
{
    /** @var  AuthenticationService */
    protected $authenticationService;

    /** @var ServiceLocatorInterface */
    protected $serviceManager;

    /**
     * AuthenticationController constructor.
     * @param AuthenticationService $authenticationService
     * @param ServiceLocatorInterface $serviceManager
     */
    public function __construct(AuthenticationService $authenticationService, ServiceLocatorInterface $serviceManager)
    {
        $this->authenticationService = $authenticationService;
        $this->serviceManager = $serviceManager;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function loginAction()
    {

        /** @var ViewModel $viewModel */
        $viewModel = new ViewModel;

        if ($this->getRequest()->isPost()) {
            /** @var ObjectRepository $adapter */
            $adapter = $this->authenticationService->getAdapter();

            /** @var array $params */
            $params = $this->params()->fromPost();

            $adapter->setIdentity($params['username']);
            $adapter->setCredential($params['password']);

            /** @var Result $authenticationResult */
            $authenticationResult = $this->authenticationService->authenticate();

            if ($authenticationResult->isValid()) {

                /** @var Redirect $redirect */
                $redirect = $this->redirect();

                if (!empty($params['redirect'])) {
                    return $redirect->toUrl(
                        base64_decode($params['redirect'])
                    );
                }

                return $redirect->toRoute('cpanel');

            } else {
                $viewModel->setVariable(
                    'messages', $authenticationResult->getMessages()
                );
            }
        }

        $this->layout(
            $this->serviceManager->get(Module::class)
                ->get('default_layout_authorized')
        );

        $viewModel->setVariable(
            'form', $this->serviceManager
                ->get('FormElementManager')
                ->get(LoginForm::class)
        );

        $viewModel->setTemplate(
            $this->serviceManager
                ->get(\MSBios\Guard\Module::class)
                ->get('template')
        );

        return $viewModel;
    }

    /**
     * @return \Zend\Http\Response
     */
    public function logoutAction()
    {
        $this->authenticationService
            ->clearIdentity();

        return $this->redirect()
            ->toRoute('cpanel');
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}
