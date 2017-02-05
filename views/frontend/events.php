<?php

$view->script('moment', 'https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js');
$view->script('jquery', 'https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js');
$view->script('fullcalendar', 'https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js');

$view->script('events', 'events:js/frontend/events.js', ['vue', 'fullcalendar']);

?>
<link href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css" rel="stylesheet">
<link href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.print.min.css" rel="stylesheet" media='print'>


<br><br>
<div id="events" v-cloak>
    <div id="calendar"></div>
</div>
<br>


