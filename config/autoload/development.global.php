<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Guard\CPanel;

return [
    'db' => [
        'dsn' => 'mysql:dbname=portal.dev;host=127.0.0.1',
        'username' => 'root',
        'password' => 'root',
    ],

    \MSBios\Assetic\Module::class => [
        'paths' => [
            __DIR__ . '/../../vendor/msbios/cpanel/themes/limitless/public',
        ],
    ],

];
