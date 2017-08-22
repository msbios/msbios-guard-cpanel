<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel;

use Zend\Router\Http\Segment;

return [

    'doctrine' => [
        'authentication' => [
            'orm_default' => [
                'identity_class' => \MSBios\Guard\Resource\Entity\User::class,
                'identity_property' => 'username',
                'credential_property' => 'password'
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'cpanel' => [
                'child_routes' => [
                    'authentication' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => ':action[/]',
                            'defaults' => [
                                'controller' => Controller\AuthenticationController::class,
                            ],
                            'constraints' => [
                                'action' => 'login|logout'
                            ]
                        ]
                    ],
                    'resource' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'resource[/[:action[/[:id[/]]]]]',
                            'defaults' => [
                                'controller' => Controller\ResourceController::class,
                            ],
                            'constraints' => [
                                'action' => 'add|edit|drop',
                                'id' => '[0-9]+'
                            ]
                        ]
                    ],
                    'user' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'user[/[:action[/[:id[/]]]]]',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                            ],
                            'constraints' => [
                                'action' => 'add|edit|drop',
                                'id' => '[0-9]+'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],

    'controllers' => [

        'abstract_factories' => [
            // Mvc\Controller\LazyControllerAbstractFactory::class,
        ],

        'factories' => [
            Controller\AuthenticationController::class =>
                Factory\AuthenticationControllerFactory::class,
            Controller\ResourceController::class =>
                \MSBios\CPanel\Factory\LazyActionControllerFactory::class,
            Controller\UserController::class =>
                \MSBios\CPanel\Factory\LazyActionControllerFactory::class,
        ]
    ],

    'navigation' => [
        \MSBios\CPanel\Navigation\Sidebar::class => [
            'acl' => [
                'label' => _('Access Control List'),
                'uri' => '#',
                'class' => 'icon-accessibility',
                'order' => 100400,
                'pages' => [
                    'user' => [
                        'label' => _('Users'),
                        'route' => 'cpanel/user',
                        'pages' => [
                            [
                                'label' => _('Create new user'),
                                'route' => 'cpanel/user',
                                'action' => 'add'
                            ], [
                                'label' => _('Edit user record'),
                                'route' => 'cpanel/user',
                                'action' => 'edit'
                            ],
                        ]
                    ],
                    'resource' => [
                        'label' => _('Resources'),
                        'route' => 'cpanel/resource',
                        'pages' => [
                            [
                                'label' => _('Create new resource'),
                                'route' => 'cpanel/resource',
                                'action' => 'add'
                            ], [
                                'label' => _('Edit user resource'),
                                'route' => 'cpanel/resource',
                                'action' => 'edit'
                            ],
                        ]
                    ],
                    'role' => [
                        'label' => _('Roles'),
                        'uri' => '#'
                    ],
                    'rule' => [
                        'label' => _('Rules'),
                        'uri' => '#'
                    ],
                ],
            ],
        ],
    ],

    'service_manager' => [
        'invokables' => [
            // Listeners
            Listener\ForbiddenListener::class
        ],
        'factories' => [
            Module::class =>
                Factory\ModuleFactory::class,

            // Providers
            Provider\Identity\AuthenticationProvider::class =>
                Factory\AuthenticationProviderFactory::class
        ]
    ],

    'form_elements' => [
        'factories' => [
            Form\LoginForm::class => Factory\LoginFormFactory::class,
        ]
    ],

    'input_filters' => [
        'invokables' => [
            // some thing
        ],
        'factories' => [
            // InputFilter\ModuleInputFilter::class => Factory\LazyInputFilterFactory::class,
            // InputFilter\TemplateInputFilter::class => Factory\LazyInputFilterFactory::class,
            // InputFilter\UserInputFilter::class => Factory\LazyInputFilterFactory::class
        ]
    ],

    \MSBios\Theme\Module::class => [
        'themes' => [
            'limitless' => [

                'template_map' => [
                    'error/403' => __DIR__ . '/../themes/limitless/view/error/403.phtml'
                ],

                'template_path_stack' => [
                    __DIR__ . '/../themes/limitless/view/',
                ],
                'controller_map' => [
                ],
                'translation_file_patterns' => [
                    [
                        'type' => 'gettext',
                        'base_dir' => __DIR__ . '/../themes/limitless/language/',
                        'pattern' => '%s.mo',
                    ],
                ],
            ],
            'paper' => [

                'template_map' => [
                    'error/403' => __DIR__ . '/../themes/paper/view/error/403.phtml'
                ],

                'template_path_stack' => [
                    __DIR__ . '/../themes/paper/view/',
                ],
                'controller_map' => [
                ],
                'translation_file_patterns' => [
                    [
                        'type' => 'gettext',
                        'base_dir' => __DIR__ . '/../themes/paper/language/',
                        'pattern' => '%s.mo',
                    ],
                ],
            ]
        ]
    ],

    \MSBios\CPanel\Module::class => [
        'controllers' => [ // key controller
            Controller\ResourceController::class => [
                'route_name' => 'cpanel/resource',
                'resource_class' => \MSBios\Guard\Resource\Entity\Resource::class,
                'form_element' => \MSBios\Guard\Resource\Form\UserForm::class,
                'item_count_per_page' => 10 // optional
            ],
            Controller\UserController::class => [
                'route_name' => 'cpanel/user',
                'resource_class' => \MSBios\Guard\Resource\Entity\User::class,
                'form_element' => \MSBios\Guard\Resource\Form\UserForm::class,
                'item_count_per_page' => 10 // optional
            ]
        ]
    ],

    \MSBios\Guard\Module::class => [

        'identity_provider' => Provider\Identity\AuthenticationProvider::class,

        'role_providers' => [
            \MSBios\Guard\Provider\RoleProvider::class => [
            ]
        ],

        'resource_providers' => [
            \MSBios\Guard\Provider\ResourceProvider::class => [
                Controller\AuthenticationController::class => [],
                Controller\ResourceController::class => [],
                Controller\UserController::class => []
            ]
        ],

        'rule_providers' => [
            \MSBios\Guard\Provider\RuleProvider::class => [
                'allow' => [
                    [['GUEST'], Controller\AuthenticationController::class],
                    [['DEVELOPER'], Controller\ResourceController::class],
                    [['DEVELOPER'], Controller\UserController::class]
                ],
                'deny' => []
            ]
        ],
    ],

    Module::class => [
        // Layout for authentication view
        'default_layout_authorized' => 'layout/login_simple',

        // Module listeners
        'listeners' => [
            Listener\ForbiddenListener::class => [
                'listener' => Listener\ForbiddenListener::class,
                'method' => 'onDispatchError',
                'event' => \Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,
                'priority' => -100900,
            ],
        ]
    ],
];
