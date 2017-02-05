<?php

$view->script('moment', 'https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js');
$view->script('jquery', 'https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js');
$view->script('fullcalendar', 'https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js');

$view->script('events', 'events:js/events-frontend.js', ['vue']);
?>
<link href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css" rel="stylesheet">
<link href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.print.min.css" rel="stylesheet" media='print'>


<br><br>
<div id="events" v-cloak>
    <div id="calendar"></div>
</div>
<br>
<!--<div id="events" v-cloak>-->
<!--    <h1>{{ 'Events' | trans }}</h1>-->
<!--    <p>{{ 'This page is a work in progress' | trans }}</p>-->
<!--    <ul>-->
<!--        <li v-for="event in events">-->
<!--            <a :href="$url.route('events/'+event.id)">-->
<!--                <h3>{{ event.title }}</h3>-->
<!--            </a>-->
<!--        </li>-->
<!--    </ul>-->
<!--</div>-->

