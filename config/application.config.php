<?php
/**
 * If you need an environment-specific system or application configuration,
 * there is an example in the documentation
 * @see https://docs.zendframework.com/tutorials/advanced-config/#environment-specific-system-configuration
 * @see https://docs.zendframework.com/tutorials/advanced-config/#environment-specific-application-configuration
 */
return [
    // Retrieve list of modules used in this application.
    'modules' => [
        'MSBios\Test',
        'MSBios\Form',
        'Zend\Db',
        'MSBios\I18n',
        'Zend\Mvc\Plugin\FilePrg',
        'Zend\Filter',
        'Zend\Mvc\Plugin\Identity',
        'Zend\Mvc\Plugin\Prg',
        'Zend\Validator',
        'Zend\Session',
        'Zend\Form',

        'Zend\Mvc\Plugin\FlashMessenger',
        'Zend\I18n',
        'Zend\Navigation',
        'Zend\Router',
        'Zend\InputFilter',
        'Zend\Hydrator',

        'MSBios\Assetic',
        'MSBios\Widget',
        'MSBios\Theme',
        'MSBios\Navigation',
        'MSBios\Application',

        'MSBios\Resource',
        'MSBios\Authentication',
        'MSBios\Guard',
        'MSBios\Guard\CPanel',
        'MSBios\Guard\Resource',
        'MSBios\CPanel',

        'Zend\Log',
        'ZendDeveloperTools',
    ],

    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php',
        ],
        'config_cache_enabled' => false,
        // 'config_cache_key' => 'application.config.cache',
        'module_map_cache_enabled' => false,
        // 'module_map_cache_key' => 'application.module.cache',
        'cache_dir' => 'data/cache/',
    ],
];
