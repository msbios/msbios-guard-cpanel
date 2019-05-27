<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel;

use MSBios\CPanel\Factory\ControllerFactory;
use MSBios\Factory\ModuleFactory;
use Zend\Router\Http\Segment;

return [

    'router' => [
        'routes' => [
            'cpanel' => [
                'child_routes' => [
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
                    'resource-permission' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'resource-permission/:resource_id[/[:action[/[:id[/]]]]]',
                            'defaults' => [
                                'controller' => Controller\Resource\PermissionController::class,
                            ],
                            'constraints' => [
                                'action' => 'add|edit|drop',
                                'resource_id' => '[0-9]+',
                                'id' => '[0-9]+'
                            ]
                        ]
                    ],
                    'role' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'role[/[:action[/[:id[/]]]]]',
                            'defaults' => [
                                'controller' => Controller\RoleController::class,
                            ],
                            'constraints' => [
                                'action' => 'add|edit|drop',
                                'id' => '[0-9]+'
                            ]
                        ]
                    ],
                    'rule' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => 'rule[/[:action[/[:id[/]]]]]',
                            'defaults' => [
                                'controller' => Controller\RuleController::class,
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
        'factories' => [
            Controller\ResourceController::class =>
                ControllerFactory::class,
            Controller\Resource\PermissionController::class =>
                ControllerFactory::class,
            Controller\RoleController::class =>
                ControllerFactory::class,
            Controller\RuleController::class =>
                ControllerFactory::class,
            Controller\UserController::class =>
                ControllerFactory::class,
        ]
    ],

    'navigation' => [
        \MSBios\CPanel\Navigation\Sidebar::class => [
            'acl' => [
                'label' => _('Access Control List'),
                'uri' => '#',
                'class' => 'icon-accessibility',
                'order' => 100400,
                'resource' => Mvc\Controller\ActionControllerInterface::class,
                'pages' => [
                    'user' => [
                        'label' => _('Users'),
                        'route' => 'cpanel/user',
                        'resource' => Controller\UserController::class,
                        // 'pages' => [
                        //     [
                        //         'label' => _('Create new user'),
                        //         'route' => 'cpanel/user',
                        //         'action' => 'add'
                        //     ], [
                        //         'label' => _('Edit user record'),
                        //         'route' => 'cpanel/user',
                        //         'action' => 'edit'
                        //     ],
                        // ]
                    ],
                    'resource' => [
                        'label' => _('Resources'),
                        'route' => 'cpanel/resource',
                        'resource' => Controller\ResourceController::class,
                        // 'pages' => [
                        //     [
                        //         'label' => _('Create new resource'),
                        //         'route' => 'cpanel/resource',
                        //         'action' => 'add'
                        //     ], [
                        //         'label' => _('Edit user resource'),
                        //         'route' => 'cpanel/resource',
                        //         'action' => 'edit'
                        //     ], [
                        //         'label' => _('Resource Permissions'),
                        //         'route' => 'cpanel/resource-permission',
                        //         'pages' => [
                        //             [
                        //                 'label' => _('Create resource permission'),
                        //                 'route' => 'cpanel/resource-permission',
                        //                 'action' => 'add'
                        //             ], [
                        //                 'label' => _('Edit resource permission'),
                        //                 'route' => 'cpanel/resource-permission',
                        //                 'action' => 'edit'
                        //             ],
                        //         ]
                        //     ],
                        // ]
                    ],
                    'role' => [
                        'label' => _('Roles'),
                        'route' => 'cpanel/role',
                        'resource' => Controller\RoleController::class,
                            // 'pages' => [
                            //     [
                            //         'label' => _('Create new role'),
                            //         'route' => 'cpanel/role',
                            //         'action' => 'add'
                            //     ], [
                            //         'label' => _('Edit user role'),
                            //         'route' => 'cpanel/role',
                            //         'action' => 'edit'
                            //     ],
                            // ]
                    ],
                    'rule' => [
                        'label' => _('Rules'),
                        'route' => 'cpanel/rule',
                        'resource' => Controller\RuleController::class,
                            // 'pages' => [
                            //     [
                            //         'label' => _('Create new rule'),
                            //         'route' => 'cpanel/rule',
                            //         'action' => 'add'
                            //     ], [
                            //         'label' => _('Edit rule'),
                            //         'route' => 'cpanel/rule',
                            //         'action' => 'edit'
                            //     ],
                            // ]
                    ],
                ],
            ],
        ],
    ],

    'service_manager' => [
        'factories' => [
            Module::class =>
                ModuleFactory::class,
        ]
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            ],
        ]
    ],

    \MSBios\Theme\Module::class => [
        'themes' => [
            'limitless' => [
                'template_path_stack' => [
                    __DIR__ . '/../themes/limitless/view/',
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
                'resource' => Controller\ResourceController::class,
                'route_name' => 'cpanel/resource',
                'resource_class' => \MSBios\Guard\Resource\Entity\Resource::class,
                'form_element' => \MSBios\Guard\Resource\Form\UserForm::class,
                'item_count_per_page' => 10 // optional
            ],
            Controller\RoleController::class => [
                'resource' => Controller\RoleController::class,
                'route_name' => 'cpanel/role',
                'resource_class' => \MSBios\Guard\Resource\Entity\User::class,
                'form_element' => \MSBios\Guard\Resource\Form\UserForm::class,
                'item_count_per_page' => 10 // optional
            ],
            Controller\UserController::class => [
                'resource' => Controller\UserController::class,
                'route_name' => 'cpanel/user',
                'resource_class' => \MSBios\Guard\Resource\Entity\User::class,
                'form_element' => \MSBios\Guard\Resource\Form\UserForm::class,
                'item_count_per_page' => 10 // optional
            ]
        ]
    ],

    \MSBios\Guard\Module::class => [

        'role_providers' => [
            \MSBios\Guard\Provider\RoleProvider::class => [
                // ...
            ]
        ],

        'resource_providers' => [
            \MSBios\Guard\Provider\ResourceProvider::class => [
                Mvc\Controller\ActionControllerInterface::class => [
                    Controller\ResourceController::class,
                    Controller\Resource\PermissionController::class,
                    Controller\RoleController::class,
                    Controller\RuleController::class,
                    Controller\UserController::class
                ]
            ]
        ],

        'rule_providers' => [
            \MSBios\Guard\Provider\RuleProvider::class => [
                'allow' => [
                    [['DEVELOPER'], Mvc\Controller\ActionControllerInterface::class],
                ],
                'deny' => []
            ]
        ],
    ],
];
