<?php
use Pagekit\Application as App;
$testb = 'Trying';

// TODO: Move to widget.php
$settings = App::module('events')->config['settings'];

// TODO: Figure out the right way to send a php variable to vuejs
echo "<script>var testb = ".json_encode($events).";</script>";

$view->style('events-bootstrap', 'events:assets/css/frontend/listWidget.css');

$view->script('utils', 'events:js/utils.js', 'vue');
$view->script('moment', 'events:assets/js/libraries/moment.min.js');
$view->script('eventList', 'events:js/eventListWidget.js', ['utils', 'vue', 'moment']);

$color = '#BA0000';
$even = '#fff';
$odd = '#f1f1f1';

?>

<style>
    .jebster_calendar_icon { border: 5px solid <?= $color ?>; }
    .jebster_calendar_icon::before { border: 5px solid <?= $color ?>; background-color: <?= $color ?>; }
    .jebster_event:nth-child(even){ background-color: <?= $even ?>; }
    .jebster_event:nth-child(odd){ background-color: <?= $odd ?>; }
</style>

<div id="eventList" class="jebster_event_list" v-cloak>
    <h3 style="text-align: center;"><a href="/events" class="jebster_event_link">
            {{ 'Schedule for the week' | trans }}
        </a></h3>

    <?php

    if(sizeof($events) <= 0): ?>
        <div><?= __('No future events') ?></div>
    <?php endif; ?>
    <div class="jebster_event" v-for="event in events">
        <a href="/events/{{event.link}}" class="jebster_event_link">
            <div class="jebster_icon">
                <div class="jebster_calendar_icon"></div>
                <span class="jebster_month">
                    {{ event.month }}
                </span>
                <span class="jebster_dayNumber" :class="{'jebster_onedigit': event.day_number < 10}">
                    {{ event.day_number }}
                </span>
                <span class="jebster_dayName">
                    {{ event.day_name }}
                </span>
            </div>
            <div style="margin: 0 0 0 62px;">
                <p class="jebster_event_title">
                        {{ event.title }} -
                        {{ event.time_interval }}
                </p>
                <p class="jebster_event_shortdescription">
                    &nbsp;{{ event.short_description }}&nbsp;
                </p>
                <p class="jebster_event_description clearfix">
                    {{ 'at %location%' | trans {location: event.location} }}
                </p>
            </div>
        </a>
    </div>

</div>

