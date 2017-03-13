<?php

$view->script('moment', 'events:assets/js/libraries/moment.min.js', 'jquery');
$view->script('full-calendar', 'events:assets/js/libraries/fullcalendar.min.js', 'moment');

$view->script('events', 'events:js/frontend/events.js', ['vue', 'full-calendar', 'moment','jquery']);

$view->style('jquery-ui', 'events:assets/css/libraries/jquery-ui.min.css');
$view->style('jquery-ui-structure', 'events:assets/css/libraries/jquery-ui.structure.min.css');
$view->style('jquery-ui-theme', 'events:assets/css/libraries/jquery-ui.theme.min.css');

?>
<link href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css" rel="stylesheet">
<link href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.print.min.css" rel="stylesheet" media='print'>


<br><br>
<div id="events" v-cloak>
    <div id="calendar"></div>
</div>
<br>


