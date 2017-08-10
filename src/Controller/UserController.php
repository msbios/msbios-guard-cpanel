<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 *
 */
namespace MSBios\Guard\CPanel\Controller;

use MSBios\CPanel\Mvc\Controller\LazyAbstractActionController;

use MSBios\Guard\Resource\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class UserController
 * @package MSBios\Guard\CPanel\Controller
 */
class UserController extends LazyAbstractActionController
{
    /**
     * @param MvcEvent $e
     */
    public function onDispatch(MvcEvent $e)
    {
        $this->getEventManager()->attach(self::PERSIST_OBJECT, [$this, 'onPersistObject']);
        $this->getEventManager()->attach(self::MERGE_OBJECT, [$this, 'onMergeObject']);
        parent::onDispatch($e);
    }

    /**
     * @param EventInterface $e
     */
    public function onPersistObject(EventInterface $e)
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
    public function onMergeObject(EventInterface $e)
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
