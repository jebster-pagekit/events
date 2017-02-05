<?php
$testb = 'Trying';

echo "<script>var testb = ".json_encode($events).";</script>";

$view->script('utils', 'events:js/utils.js', 'vue');
$view->script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js');
$view->script('eventList', 'events:js/eventListWidget.js', ['utils', 'vue', 'moment']);

?>


<style>
    .jebster_event_list{

    }

    .jebster_event{
        padding: 6px;
        text-align: center;
        height: 80px;
    }

    .jebster_event .jebster_image{
        position: relative;
        float: left;
        width: 56px;
        height: 56px;
    }

    .jebster_event .jebster_image .jebster_calendar_icon{
        width: 62px;
        height: 62px;
        background-color: #BA0000;
        -webkit-mask-repeat: no-repeat;
        -webkit-mask-size: 58px;
        margin: 4px 0 0 2px;
    }

    .jebster_event_title{
        margin: 10px 0 0 0;
        font-size: 16px;
    }

    .jebster_event_description{
        font-size: 12px;
        font-style: italic;
        line-height:12px;
    }

    .jebster_event:nth-child(even){
        background-color: #fff;
    }

    .jebster_event:nth-child(odd){
        background-color: #f1f1f1;
    }

    span.jebster_month{
        position: absolute;
        top: 5px;
        left: 20px;
        color: white;
        font-size: 13px;
        font-weight:bold;
    }

    span.jebster_dayNumber{
        position: absolute;
        top: 28px;
        left: 20px;
        font-size: 18px;
        font-weight:bold;
    }

    span.jebster_dayName{
        position: absolute;
        top: 42px;
        left: 21px;
        font-size: 12px;
    }

    span.jebster_onedigit{
        left: 26px;
    }

    .jebster_event_link{
        color: black;
    }

</style>

<div id="eventList" class="jebster_event_list">
    <h3><a href="events" class="jebster_event_link">Schedule for the week</a></h3>

    <?php

    if(sizeof($events) <= 0): ?>
        <div><?= __('No future events') ?></div>
    <?php endif; ?>
    <div class="jebster_event" v-for="event in events">
        <div class="jebster_image">
            <!-- TODO: just use css instead of image -->
            <div class="jebster_calendar_icon" style="
                    -webkit-mask-image: url('<?= $view->url()->getStatic('events:assets/images/test.png') ?>');">
            </div>
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
        <p class="jebster_event_title">
            <a href="events/{{event.id}}" class="jebster_event_link">
                {{ event.title }} -
                {{ event.time_interval }}
            </a>
        </p>
        <p class="jebster_event_description clearfix">
            {{ 'at %location%' | trans {location: event.location} }}
        </p>
    </div>

</div>

