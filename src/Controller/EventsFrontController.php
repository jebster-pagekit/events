<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 2/4/17
 * Time: 9:59 PM
 */

namespace Jebster\Events\Controller;

use DateInterval;
use DateTime;
use Jebster\Events\Model\Event;
use Pagekit\Application as App;

class EventsFrontController
{
    /**
     *
     */
    public function indexAction(){
        $from = (new DateTime())->sub(new DateInterval("P1Y"));
        $to = (new DateTime())->add(new DateInterval("P5Y"));
        $events = Event::getEvents($from, $to, 7500);

        return [
            '$view' => [
                'title' => __("Events"),
                'name' => 'events:views/frontend/events.php'
            ],
            '$data' => [
                'events' => $events
            ]
        ];
    }

    /**
     * @Route("/{slug}", methods="GET")
     */
    public function eventAction($slug = 0){
        $event = Event::findFromSlug($slug);
        if($event == null || !$event->active)
            App::abort(404, __('Event not found'));

        $view = ['title' => $event->title, 'name' => 'events:views/frontend/event.php'];

        if($event->get('og') != null){
            $og = $event->get('og');
            if(key_exists('title', $og)) $view['og:title'] = $og['title'];
            if(key_exists('description', $og)) $view['og:description'] = $og['description'];
            if(key_exists('image', $og) && key_exists('src', $og['image']) && strlen($og['image']['src']) > 1)
                $view['og:image'] = App::url()->getStatic($og['image']['src'], [], 0);
        }

        return [
            '$view' => $view,
            '$data' => [
                'event' => $event
            ],
            'event' => $event
        ];
    }

}