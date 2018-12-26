<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 *
 */
namespace MSBios\Guard\CPanel\Controller;

use MSBios\CPanel\Mvc\Controller\AbstractActionController;
use MSBios\Guard\Resource\Record\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class UserController
 * @package MSBios\Guard\CPanel\Controller
 */
class UserController extends AbstractActionController
{
    /**
     * @param MvcEvent $e
     */
    public function onDispatch(MvcEvent $e)
    {
        /** @var EventManagerInterface $eventManager */
        $eventManager = $this->getEventManager();
        $eventManager->attach(self::EVENT_PRE_PERSIST_DATA, [$this, 'onPersistData']);
        $eventManager->attach(self::EVENT_PRE_MERGE_DATA, [$this, 'onMergeData']);
        parent::onDispatch($e);
    }

    /**
     * @param EventInterface $e
     */
    public function onPersistData(EventInterface $e)
    {
        /** @var User $entity */
        $entity = $e->getParam('entity');

        /** @var Bcrypt $bcrypt */
        $bcrypt = new Bcrypt;
        $entity->setPassword($bcrypt->create($entity->getPassword()));
    }

    /**
     * @param EventInterface $e
     */
    public function onMergeData(EventInterface $e)
    {
        /** @var User $object */
        $object = $e->getParam('object');

        /** @var User $entity */
        $entity = $e->getParam('entity');
        $entity->setPassword($object->getPassword());

        /** @var array $data */
        $data = $e->getParam('data');

        if (! empty($data['password'])) {

            /** @var Bcrypt $bcrypt */
            $bcrypt = new Bcrypt;
            $entity->setPassword($bcrypt->create($data['password']));
        }
    }
}
