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
    public $description = '';

    /** @Column(type="integer") */
    public $creator_id;

    /** @BelongsTo(targetEntity="Pagekit\User\Model\User", keyFrom="creator_id") */
    public $creator;

    /** @Column */
    public $location = '';

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

    /**
     * @param int $count
     * @return static[]
     */
    public static function getNext($count = 10){
        // TODO: redo this method, so it's cleaner and faster.
        $events = array_values(Event::query()
            ->where('repeating is null')
            ->where('end >= CURDATE()')
            ->orderBy('start')
            ->limit($count)
            ->get());

        $repeating = array_values(Event::query()
            ->where('repeating is not null')
            ->get());

        foreach ($repeating as $e) {
            array_push($events, $e);
            $r = clone $e;
            for ($i = 0; $i < $count; $i++){
                $r = clone $r;
                $interval = new DateInterval('P'.$r->repeating.'D');
                $r->start->add($interval);
                $r->end->add($interval);
                if($r->end > new DateTime())
                    array_push($events, $r);
            }
        }

        usort($events, function($e1, $e2){
            return
                $e1->start == $e2->start ? 0
                    : $e1->start > $e2->start
                        ? 1 : -1;
        });

        $events = array_slice($events, 0, $count);

        return $events;
    }

    function __clone()
    {
        $this->start = clone $this->start;
        $this->end = clone $this->end;
        $this->creator = $this->creator != null ? clone $this->creator : null;
    }
}