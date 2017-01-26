<?php $view->script('events', 'events:js/events-index.js', 'vue') ?>

<div id="events" class="uk-form" v-cloak>

    <a class="uk-button uk-button-primary" :href="$url.route('admin/events/edit')">{{ 'Add Event' | trans }}</a>

    <ul>
        <li v-for="event in events">
            <a :href="$url.route('admin/events/edit/'+event.id)">
                {{ event.title }}
            </a>
        </li>
    </ul>

</div>
