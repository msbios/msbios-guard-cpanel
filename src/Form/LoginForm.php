<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Guard\CPanel\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class LoginForm
 * @package MSBios\Guard\CPanel\Form
 */
class LoginForm extends Form
{
    /**
     * LoginForm constructor.
     * @param int|null|string $name
     * @param array $options
     */
    public function __construct($name = __CLASS__, array $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'type' => Text::class,
            'name' => 'username'
        ]);

        $this->add([
            'type' => Password::class,
            'name' => 'password'
        ]);

        $this->add([
            'type' => Hidden::class,
            'name' => 'redirect'
        ]);
    }
}
