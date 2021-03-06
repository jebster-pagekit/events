<?php

use Jebster\Events\Model\Event;
use Pagekit\Application as App;

return [
    'name' => 'jebster/eventListWidget',

    'label' => 'Events List',

    'events' => [
/*
        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('widget-eventListWidget', 'events:js/widget.js', ['~widgets']);
        }*/

    ],

    'render' => function ($widget) use ($app) {
        // TODO: Figure out the right way to remove the title!
        // TODO: Add option in admin panel to remove the title
        $widget->title = "";

        $events = Event::getNext(App::module('events')->config['settings']['max']);

        return $app->view('events/widgets/eventListWidget.php', compact('events'));
    }
];