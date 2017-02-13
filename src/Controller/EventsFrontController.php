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
     * @Route("/{id}", requirements={"id"="\d+"}, methods="GET")
     */
    public function eventAction($id = 0){
        $event = Event::find($id);
        if($event == null || !$event->active)
            App::abort(404, __('Event not found'));
        return [
            '$view' => [
                'title' => $event->title,
                'name' => 'events:views/frontend/event.php'
            ],
            '$data' => [
                'event' => $event
            ]
        ];
    }

}