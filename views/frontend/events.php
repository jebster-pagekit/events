<?php
$view->script('events', 'events:js/events-frontend.js', ['vue'])
?>

<div id="events" v-cloak>
    <h1>{{ 'Events' | trans }}</h1>
    <p>{{ 'This page is a work in progress' | trans }}</p>
    <ul>
        <li v-for="event in events">
            <a :href="$url.route('events/'+event.id)">
                <h3>{{ event.title }}</h3>
            </a>
        </li>
    </ul>
</div>

