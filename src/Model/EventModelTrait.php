<?php

namespace Jebster\Events\Model;

use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;

trait EventModelTrait
{
    use ModelTrait;

    /**
     * @Saving
     */
    public static function saving($e, Event $event)
    {
//        $post->modified = new \DateTime();

        $i  = 2;
        $id = $event->id;

        while (self::where('slug = ?', [$event->slug])->where(function ($query) use ($id) {
            if ($id) {
                $query->where('id <> ?', [$id]);
            }
        })->first()) {
            $event->slug = preg_replace('/-\d+$/', '', $event->slug).'-'.$i++;
        }
    }

    public static function findFromSlug($slug){
        $event = self::where('slug = ?', [$slug])->first();
        if($event == null){
            App::abort(404, __('Event not found'));
        }
        return $event;
    }
}