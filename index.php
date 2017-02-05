<?php

use Pagekit\Application;
return [
    'name' => 'events',
    'main' => function(Application $app) {
    },
    'autoload' => [
        'Jebster\\Events\\' => 'src'
    ],
    'resources' => [
        'events:' => ''
    ],

    'routes' => [
        'admin/events' => [
            'path' => '/events',
            'controller' => 'Jebster\\Events\\Controller\\EventsController'
        ],
        'events' => [
            'path' => '/events',
            'controller' => 'Jebster\\Events\\Controller\\EventsFrontController'
        ]
    ],

    'widgets' => [
        'widgets/eventListWidget.php'
    ],

    'config' => [
        'settings' => [
            'max' => 8,
            'uri-calendar' => 'calendar',
            'uri-events' => 'events'
        ]
    ],

    'menu' => [
        'events' => [
            'label'  => 'Events',
            'icon'   => 'app/system/assets/images/placeholder-icon.svg',
            'url'    => '@events/events',
            'active' => '@events/*'
        ],

        'events: events' => [
            'label' => 'Events',
            'parent' => 'events',
            'url' => '@events/events',
            'active' => '@events/events*',
        ],

        'events: settings' => [
            'label' => 'Settings',
            'parent' => 'events',
            'url' => '@events/settings',
            'active' => '@events/settings*',
        ]
    ],


    'settings' => '@events/settings',
];