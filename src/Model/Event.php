<?php

/**
 * Created by PhpStorm.
 * User: jeggy
 * Date: 1/24/17
 * Time: 10:16 PM
 */

namespace Jebster\Events\Model;

use DateInterval;
use DateTime;
use Pagekit\Database\ORM\ModelTrait;
use Pagekit\Application as App;

/**
 * @Entity(tableClass="@jebster_event")
 */
class Event
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column */
    public $title = '';

    /** @Column(type="text") */
    public $short_description = '';

    /** @Column(type="text") */
    public $description = '';

    /** @Column(type="integer") */
    public $creator_id;

    /** @BelongsTo(targetEntity="Pagekit\User\Model\User", keyFrom="creator_id") */
    public $creator;

    /** @Column */
    public $location = '';

    /** @Column(type="boolean") */
    public $map = false;

    /** @Column(type="datetime") */
    public $start;

    /** @Column(type="datetime") */
    public $end;

    /** @Column */
    public $fb_event = '';

    /** @Column(type="boolean") */
    public $active = true;

    /** @Column(type="integer") */
    public $repeating = null;

    public static function getEvents($from, $to, $count = 10){
        // TODO: redo this method, so it's cleaner and faster.
        $events = Event::query()
            ->where('repeating is null')
            ->where('active = 1');

        $events = $events->where('end >= ?', [$from]);
        if($to != null){
            $events = $events->where('end <= ?', [$to]);
        }


        $events = $events->orderBy('start');
        if($count != null)
            $events = $events->limit($count);

        $events = $events->get();

        $events = array_values($events);

        $repeating = array_values(Event::query()
            ->where('repeating is not null')
            ->where('active = 1')
            ->get());

        foreach ($repeating as $e) {
            if($e->end > $from)
                array_push($events, $e);
            $r = clone $e;

            $recreate = function () use(&$r, $from, $to, &$events){
                $r = clone $r;
                $interval = new DateInterval('P' . $r->repeating . 'D');
                $r->start->add($interval);
                $r->end->add($interval);

                if($to != null && $to < $r->end) return false;
                if ($r->end > $from) array_push($events, $r);

                return true;
            };

            $i = 0;
            while($recreate() && ($count == null || $count >= $i))
                $i++;
        }

        usort($events, function($e1, $e2){
            return
                $e1->start == $e2->start ? 0
                    : $e1->start > $e2->start
                    ? 1 : -1;
        });

        if($count != null)
            $events = array_slice($events, 0, $count);

        return $events;
    }

    /**
     * @param int $count
     * @return static[]
     */
    public static function getNext($count = 10){
        return self::getEvents(new DateTime(), null, $count);
    }



    function __clone()
    {
        $this->start = clone $this->start;
        $this->end = clone $this->end;
        $this->creator = $this->creator != null ? clone $this->creator : null;
    }
}