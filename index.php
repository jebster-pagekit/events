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
        ],
        'api' => [
            'path' => '/api',
            'controller' => [
                'Jebster\\Events\\Controller\\EventApiController'
            ]
        ]
    ],

    'widgets' => [
        'widgets/eventListWidget.php'
    ],

    'config' => [
        'settings' => [
            'max' => 8,
            'uri-calendar' => 'calendar',
            'uri-events' => 'events',
            'frontEndStyle' => 'UIKit'
        ]
    ],

    'menu' => [
        'events' => [
            'label'  => 'Events',
            // https://www.iconfinder.com/icons/569109/calendar_clock_event_google_schedule_icon
            'icon'   => 'events:assets/images/menu-item.png',
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