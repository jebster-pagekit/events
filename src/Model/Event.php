<?php

namespace Jebster\Events\Model;

use DateInterval;
use DateTime;
use JsonSerializable;
use Pagekit\Database\ORM\ModelTrait;
use Pagekit\Application as App;
use Pagekit\System\Model\DataModelTrait;

/**
 * @Entity(tableClass="@jebster_event")
 */
class Event implements JsonSerializable
{
    use EventModelTrait, DataModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column */
    public $title = '';

    /** @Column */
    public $slug = '';

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

    /** @Column(type="boolean") */
    public $active = true;

    /** @Column(type="integer") */
    public $repeating = null;


    public static function getEventsOnly(){
        echo "This ever running?";
    }

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

    public static function eventsOnly($filter, $page){
        return static::querying($filter, $page, 'repeating is null');
    }

    public static function repeatingOnly($filter, $page){
        return static::querying($filter, $page, 'repeating is not null');
    }

    protected static function querying($filter, $page, $where)
    {
        $query  = static::query();
        $filter = array_merge(array_fill_keys(['search', 'active', 'order', 'limit'], ''), $filter);

        extract($filter, EXTR_SKIP);

//        if(!App::user()->hasAccess('blog: manage all posts')) {
//            $author = App::user()->id;
//        }

        if (is_numeric($active)) {
            $query->where(['active' => (int) $active]);
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->orWhere(['title LIKE :search'], ['search' => "%{$search}%"]);
            });
        }

        if($where){
            $query->where($where);
        }

        if (!preg_match('/^(title|location|start|end|)\s(asc|desc)$/i', $order, $order)) {
            $order = [1 => 'start', 2 => 'desc'];
        }



        $limit = (int) $limit ?: 10; //App::module('blog')->config('posts.posts_per_page');
        $count = $query->count();
        $pages = ceil($count / $limit);
        $page  = max(0, min($pages - 1, $page));

//        $posts = array_values($query->offset($page * $limit)->related('user', 'comments')->limit($limit)->orderBy($order[1], $order[2])->get());

        $events = array_values($query
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy($order[1], $order[2])
            ->get());

        return compact('events', 'pages', 'count');
    }

    public static function getStatuses()
    {
        return [
            1 => __('Published'),
            false => __('Unpublished'),
        ];
    }

    function __clone()
    {
        $this->start = clone $this->start;
        $this->end = clone $this->end;
        $this->creator = $this->creator != null ? clone $this->creator : null;
    }
}