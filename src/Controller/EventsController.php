<?php
/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 1/24/17
 * Time: 9:10 PM
 */

namespace Jebster\Events\Controller;

use Composer\Console\Application;
use DateTime;
use DateTimeZone;
use Jebster\Events\Model\Event;
use Jebster\Events\Util\TimeHelper;
use Pagekit\Application as App;

class EventsController
{
    /**
     * @Access(admin=true)
     */
    public function indexAction()
    {
        // TODO:
        return [];
    }

    /**
     * @Access(admin=true)
     */
    public function settingsAction()
    {
        $module = App::module('events');
        $config = $module->config;
        $settings = $config['settings'];

        return [
            '$view' => [
                'title' => __("Event Settings"),
                'name' => 'events:views/admin/events-settings.php'
            ],
            '$data' => [
                'settings' => $settings
            ]
        ];
    }

    /**
     * @Access(admin=true)
     */
    public function eventsAction()
    {
        $events = Event::where('repeating is null')->get();
        $repeating = Event::where('repeating is not null')->get();


        return [
            '$view' => [
                'title' => __("Events"),
                'name' => 'events:views/admin/events-index.php'
            ],
            '$data' => [
                // To js
                'events' => array_values($events),
                'repeating' => array_values($repeating)
            ]
        ];
    }

    /**
     * @Access(admin=true)
     * @Route("/edit", )
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods="GET")
     */
    public function editAction($id = 0){
        $event = Event::create([
            'start' => new DateTime(),
            'end' => (new DateTime())->add(date_interval_create_from_date_string('2 hours'))
        ]);
        $title = __('New event');

        if($id > 0) {
            $event = Event::find($id);
            if($event)
                $title = __("Edit '%eventTitle%'", ['%eventTitle%' => $event->title]);
            else
                // TODO: Maybe show a message instead of redirecting
                return App::redirect('@events/events');
        }

        // TODO: Fix this and remove this hack
        $event->start = $event->start->format('D M d Y H:i:s O');
        $event->end = $event->end->format('D M d Y H:i:s O');

        return [
            '$view' => [
                'title' => $title,
                'name' => 'events:views/admin/events-edit.php'
            ],
            '$data' => [
                'event' => $event
            ]
        ];
    }

    /**
     * @Request({"event": "array"}, csrf=true)
     * @Access(admin=true)
     */
    public function saveAction($event = null)
    {
        if(!$event || !$ev = Event::find($event['id'])){
            $ev = Event::create();
            $event['creator_id'] = App::user()->id;
        }else{
            $event['creator_id'] = $ev->creator_id;
        }

        $ev->save($event);

        return ['message' => 'success', 'event' => $ev];
    }

    /**
     * @Request({"id": "integer"}, csrf=true)
     * @Access(admin=true)
     */
    public function deleteAction($id = 0){
        $event = Event::find($id);
        if($event == null)
            return false;
        $event->delete();
        return ['message'];
    }

    /**
     * @Request({"max": "integer"}, csrf=true)
     * @Access(admin=true)
     */
    public function updateMaxAction($max = 8)
    {
        $module = App::module('events');
        $config = $module->config;
        $settings = $config['settings'];

        $settings['max'] = $max;

        App::config('events')->set('settings', $settings);

        return ['message' => 'success'];
    }

    /**
     * @Request({"id": "integer"}, csrf=true)
     * @Access(admin=true)
     */
    public function toggleStatusAction($id = 0)
    {
        $event = Event::find($id);
        if($event == null)
            return false;

        $event->active = !$event->active;
        $event->save();

        return ['message' => 'success'];
    }


    private function value($array, $value, $default = '2'){
        return key_exists($value, $array) ? $array[$value] : $default;
    }

}